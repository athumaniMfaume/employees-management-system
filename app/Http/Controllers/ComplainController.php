<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplainRequest;
use App\Http\Requests\UpdateComplainRequest;
use App\Services\ComplainService;

class ComplainController extends Controller
{

        protected $complainService;

    // Inject the service class
    public function __construct(ComplainService $complainService)
    {
        $this->complainService = $complainService;
    }



      public function view()
    {
        $datas = $this->complainService->getAllComplains();
        return view('employees.complain.view_complain', compact('datas'));
    }

    public function single_employee_complain_view()
    {
        $datas = $this->complainService->getEmployeeComplains();
        return view('employees.complain.view_complain', compact('datas'));
    }

    public function create()
    {
        return view('employees.complain.add_complain');
    }

    public function store(StoreComplainRequest $request)
    {
        $data = $request->validated();
        
        if ($this->complainService->createComplain($data)) {
            return redirect()->route('single.employee.complain.view')->with('success', 'Complain Added Successfully!');
        }

        return redirect()->back()->with('error', 'Error, Please Try Again Later!');
    }

    public function edit($complain)
    {
        $datas = $this->complainService->findComplainById($complain);
        return view('employees.complain.edit_complain', compact('datas'));
    }

    public function update(UpdateComplainRequest $request, $complain)
    {
        $data = $request->validated();

        if ($this->complainService->updateComplain($data, $complain)) {
            return redirect()->route('single.employee.complain.view')->with('success', 'Complain Updated Successfully!');
        }

        return redirect()->back()->with('error', 'Error, Please Try Again Later!');
    }

    public function destroy($complain)
    {
        if ($this->complainService->deleteComplain($complain)) {
            return redirect()->back()->with('success', 'Complain Deleted Successfully!');
        }

        return redirect()->back()->with('error', 'Error, Please Try Again Later!');
    }
}
