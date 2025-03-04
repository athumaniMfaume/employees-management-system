<?php

// app/Services/ApproveLeaveService.php
namespace App\Services;

use App\Models\Leave;

class ApproveLeaveService
{
    public function approveLeave($leaveId, $data)
    {
        $leave = Leave::findOrFail($leaveId);

        // Update leave data
        $leave->type = $data['type'];
        $leave->reason = $data['reason'];
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->status = $data['status'];

        // Save changes and return success or failure
        return $leave->save();
    }
}
