<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\SlideRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    public function __construct(SlideRepository $slideRepo) {
        $this->slideRepo = $slideRepo;
    }

    public function index() {
        $records = $this->slideRepo->all();
        return view('backend/slide/index', compact('records'));
    }
    public function create() {
        return view('backend/slide/create');
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->slideRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $this->slideRepo->create($input);
        return redirect()->route('admin.slide.index')->with('success', 'Thêm thành công');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $record = $this->slideRepo->find($id);
        return view('backend/slide/update', compact('record'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->slideRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $this->slideRepo->update($input,$id);
        return redirect()->route('admin.slide.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id) {
        $this->slideRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
