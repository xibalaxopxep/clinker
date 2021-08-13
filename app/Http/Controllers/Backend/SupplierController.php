<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;


class SupplierController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(SupplierRepository $supplierRepo) {
        $this->supplierRepo = $supplierRepo;
        
    }

    public function index() {
        
       
            $suppliers = $this->supplierRepo->all();
        
        return view('backend/supplier/index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/supplier/create');
    }

   
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->supplierRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
          $supplier = $this->supplierRepo->create($input);
        if ($supplier) {
            return redirect()->route('admin.supplier.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Tạo mới thất bại');
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
         $supplier = $this->supplierRepo->find($id);
        return view('backend/supplier/update')->with('supplier',$supplier);
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
        $validator = \Validator::make($input, $this->supplierRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
         $res = $this->supplierRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.supplier.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $supplier = $this->supplierRepo->find($id);
        $this->supplierRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
