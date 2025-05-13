<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplainRequest;
use App\Http\Requests\UpdateComplainRequest;
use App\Services\ComplainService;

class ComplainApiController extends Controller
{
    protected $complainService;

    public function __construct(ComplainService $complainService)
    {
        $this->complainService = $complainService;
    }

    public function index()
    {
        $data = $this->complainService->getAllComplains();
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function employeeComplains()
    {
        $data = $this->complainService->getEmployeeComplains();
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function store(StoreComplainRequest $request)
    {
        $data = $request->validated();

        if ($this->complainService->createComplain($data)) {
            return response()->json(['status' => true, 'message' => 'Complain Added Successfully!']);
        }

        return response()->json(['status' => false, 'message' => 'Error, Please Try Again Later!'], 500);
    }

    public function show($complain)
    {
        $data = $this->complainService->findComplainById($complain);
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function update(UpdateComplainRequest $request, $complain)
    {
        $data = $request->validated();

        if ($this->complainService->updateComplain($data, $complain)) {
            return response()->json(['status' => true, 'message' => 'Complain Updated Successfully!']);
        }

        return response()->json(['status' => false, 'message' => 'Error, Please Try Again Later!'], 500);
    }

    public function destroy($complain)
    {
        if ($this->complainService->deleteComplain($complain)) {
            return response()->json(['status' => true, 'message' => 'Complain Deleted Successfully!']);
        }

        return response()->json(['status' => false, 'message' => 'Error, Please Try Again Later!'], 500);
    }
}
