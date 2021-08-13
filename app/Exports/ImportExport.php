<?php

namespace App\Exports;
use App\Import;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ImportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
    	$result = DB::table('import')->get();
        return $result;
    }
    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ["Mã phiếu nhập", "Loại thanh toán","Mã kho",  "Mã nhà cung cấp","Loại hóa đơn","Ghi chú","Tổng cộng","Chiếu khấu","Loại chiết khấu","Tổng thanh toán","Đã thanh toán","Cần thanh toán","Ngày thanh toán","Người tạo","Ngày tạo","Ngày cập nhật"];
    }
}

