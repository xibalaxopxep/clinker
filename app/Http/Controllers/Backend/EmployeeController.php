<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PositionRepository;
use DB;
//use Repositories\GroupRepository;

class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $employeeRepo ,PositionRepository $positionRepo) {
        $this->employeeRepo = $employeeRepo;
        $this->positionRepo = $positionRepo;
    }

    public function index()
    {
        $records = $this->employeeRepo->all();
        return view('backend/employee/index', compact('records'));
    }
 public function create() {
        //
        $options = DB::table('position')->get();
        $group_html = \App\Helpers\StringHelper::getSelectRoleOptions($options);
        return view('backend/employee/create',compact('group_html','options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->employeeRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $employee = $this->employeeRepo->create($input);
        if ($employee->id) {
            return redirect()->route('admin.employee.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.employee.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = $this->employeeRepo->find($id);
        $options = DB::table('position')->get();
        return view('backend/employee/edit', compact('record','options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->employeeRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $res = $this->employeeRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.employee.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.employee.index')->with('error', 'Cập nhật thất bại');
        }
    }
    public function show($id)
    {
        $record = $this->employeeRepo->find($id);
        return view('backend/employee/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->employeeRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
