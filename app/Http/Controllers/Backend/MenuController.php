<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\MenuRepository;

class MenuController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MenuRepository $menuRepo) {
        $this->menuRepo = $menuRepo;
    }

    public function index() {
        $records = $this->menuRepo->all();
        foreach($records as $record){
            $record->parent = $this->menuRepo->readParentCategory($record->parent_id);
        }
        return view('backend/menu/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parent_html = \App\Helpers\StringHelper::getSelectOptions($this->menuRepo->all()->where('parent_id', 0));
        return view('backend/menu/create', compact('parent_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->menuRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $menu = $this->menuRepo->create($input);
        if ($menu->id) {
            return redirect()->route('admin.menu.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.menu.index')->with('error', 'Tạo mới thất bại');
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = $this->menuRepo->find($id);
        $parent_html = \App\Helpers\StringHelper::getSelectOptions($this->menuRepo->all()->where('parent_id', 0), $record->parent_id);
        return view('backend/menu/edit', compact('record', 'parent_html'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $input = $request->all();
        $validator = \Validator::make($input, $this->menuRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $res = $this->menuRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.menu.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.menu.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->menuRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
