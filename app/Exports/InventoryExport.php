<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class InventoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
    	$result = DB::table('inventory')->get();
        return $result;
    }
    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ["Mã phiếu kiểm ", "Tên phiếu kiểm","Ghi chú",  "Mã nhân viên tạo","Nhân viên tạo","Ngày tạo","Ngày cập nhật"];
    }
}

