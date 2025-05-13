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
        $employee = Auth::guard('employee_api')->user() ?? Auth::guard('employee')->user();
        $leave->employee_id = $employee->id;
        return $leave->save();
    }

    // Update an existing leave request
    public function updateLeave($leave, $data)
    {
    return $leave->update([
        'type' => $data['type'] ?? $leave->type,
        'reason' => $data['reason'] ?? $leave->reason,
        'start_date' => $data['start_date'] ?? $leave->start_date,
        'end_date' => $data['end_date'] ?? $leave->end_date,
    ]);
    }

    // Delete a leave request
    public function deleteLeave($leave)
    {
        return $leave->delete();
    }
}
