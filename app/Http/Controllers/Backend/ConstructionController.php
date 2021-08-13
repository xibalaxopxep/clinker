<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ConstructionRepository;
use Repositories\ItemRepository;

class ConstructionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ConstructionRepository $constructionRepo, ItemRepository $itemRepo) {
        $this->constructionRepo = $constructionRepo;
        $this->itemRepo = $itemRepo;
    }

    public function index() {
        $records = $this->constructionRepo->all();
        return view('backend/construction/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $options = $this->itemRepo->all();
        $item_html = \App\Helpers\StringHelper::getSelectOptions($options);
        return view('backend/construction/create', compact('item_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->constructionRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($input['state'])) {
            $input['state'] = 1;
        } else {
            $input['state'] = 0;
        }
        if (isset($input['vip'])) {
            $input['vip'] = 1;
        } else {
            $input['vip'] = 0;
        }
        $res = $this->constructionRepo->create($input);
        $res->items()->attach($input['item_id']);
        if ($res) {
            return redirect()->route('admin.construction.index')->with('success', 'Thêm mới thành công');
        } else {
            return redirect()->route('admin.construction.index')->with('error', 'Thêm mới thất bại');
        }
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
        $record = $this->constructionRepo->find($id);
        $options = $this->itemRepo->all();
        $item_ids = $record->items()->get()->pluck('id')->toArray();
        $item_html = \App\Helpers\StringHelper::getSelectOptions($options, $item_ids);
        return view('backend/construction/edit', compact('record', 'item_html'));
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
        $validator = \Validator::make($input, $this->constructionRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($input['state'])) {
            $input['state'] = 1;
        } else {
            $input['state'] = 0;
        }
        if (isset($input['vip'])) {
            $input['vip'] = 1;
        } else {
            $input['vip'] = 0;
        }
        $res = $this->constructionRepo->update($input, $id);
        $construction = $this->constructionRepo->find($id);
        $construction->items()->sync($input['item_id']);
        if ($res) {
            return redirect()->route('admin.construction.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.construction.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $construction = $this->constructionRepo->find($id);
        $construction->items()->detach();
        $res = $this->constructionRepo->delete($id);
        if ($res) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }

}
