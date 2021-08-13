<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct(GroupRepository $groupRepo) {
        $this->groupRepo = $groupRepo;
    }

    public function index()
    {
        $records = $this->groupRepo->all();
        return view('backend/group/index', compact('records'));
    }
 public function create() {
        //
        return view('backend/group/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->groupRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $group = $this->groupRepo->create($input);
        if ($group->id) {
            return redirect()->route('admin.group.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.group.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->groupRepo->find($id);
        return view('backend/group/edit', compact('record'));
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
        $validator = \Validator::make($input, $this->groupRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $res = $this->groupRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.group.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.group.index')->with('error', 'Cập nhật thất bại');
        }
    }
    public function show($id)
    {
        $record = $this->groupRepo->find($id);
        return view('backend/group/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->groupRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
