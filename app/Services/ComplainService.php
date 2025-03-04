<?php

namespace App\Services;

use App\Models\Complain;
use Illuminate\Support\Facades\Auth;

class ComplainService
{
    public function createComplain($data)
    {
        $complain = new Complain();
        $complain->subject = $data['subject'];
        $complain->content = $data['content'];
        $complain->employee_id = Auth::guard('employee')->user()->id;
        
        return $complain->save();
    }

    public function updateComplain($data, $complainId)
    {
        $complain = Complain::findOrFail($complainId);
        $complain->subject = $data['subject'];
        $complain->content = $data['content'];

        return $complain->update();
    }

    public function deleteComplain($complainId)
    {
        $complain = Complain::findOrFail($complainId);
        return $complain->delete();
    }

    public function getAllComplains()
    {
        return Complain::all();
    }

    public function getEmployeeComplains()
    {
        $empId = Auth::guard('employee')->user()->id;
        return Complain::where('employee_id', $empId)->get();
    }

    public function findComplainById($complainId)
    {
        return Complain::findOrFail($complainId);
    }
}
