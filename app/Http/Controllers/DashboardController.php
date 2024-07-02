<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function fetchData()
    {
        try {
            $data = Dashboard::all();
            return response()->json([
                'status' => 'True',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'False',
                'message' => 'Failed to fetch data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function receiveData(Request $request)
    {
        try {

            $data = $request->validate([
                'timestamp' => 'required|date',
                'temperature' => 'required|numeric',
                'left_off_length' => 'required|integer',
                'right_off_length' => 'required|integer',
                'tr_no' => 'required|digits:6',
                'planned_time' => 'required|integer',
            ]);

            $data['width'] = 550 - ($data['left_off_length'] + $data['right_off_length']);
            $data['current_status'] = 'running';
            $data['started_no'] = $data['timestamp'];


            DB::beginTransaction();

            $existingRecord = Dashboard::where('tr_no', $data['tr_no'])->first();
            if ($existingRecord) {
                $existingRecord->update([
                    'end_time' => $data['timestamp'],
                    'current_status' => 'closed'
                ]);
            } else {
                Dashboard::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => 'True',
                'message' => 'Received Tr No.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'False',
                'message' => 'Failed to process the request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
