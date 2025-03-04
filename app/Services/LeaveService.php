<?php

namespace App\Services;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveService
{
    // Store a new leave request
    public function storeLeave($data)
    {
        $leave = new Leave();
        $leave->type = $data['type'];
        $leave->reason = $data['reason'];
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->employee_id = Auth::guard('employee')->user()->id;

        return $leave->save();
    }

    // Update an existing leave request
    public function updateLeave($leave, $data)
    {
        $leave->type = $data['type'];
        $leave->reason = $data['reason'];
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];

        return $leave->update();
    }

    // Delete a leave request
    public function deleteLeave($leave)
    {
        return $leave->delete();
    }
}
