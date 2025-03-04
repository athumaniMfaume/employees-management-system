<?php

namespace App\Services;

use App\Models\Complain;

class ApproveComplainService
{
    // Update a complain's details
    public function updateComplain($complain, $data)
    {
        $complain->subject = $data['subject'];
        $complain->content = $data['content'];
        $complain->status = $data['status'];

        return $complain->update();
    }
}
