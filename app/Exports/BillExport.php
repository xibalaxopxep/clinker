<?php

namespace App\Exports;
use App\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class BillExport implements FromCollection, WithHeadings
{
    public function collection()
    {
    	$result = DB::table('bill')->get();
        return $result;
    }
    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ["Mã hóa đơn", "Mã kho","Tên kho","Tổng cộng","Chiếu khấu","Loại chiết khấu","Tổng thanh toán","Mã nhân viên bán","Tên nhân viên","Mã khách hàng","Tên khách hàng","Mã giảm giá","Trạng thái","Kiểu thanh toán","Khách đã thanh toán","Ghi chú","Ngày lập","Sau thanh toán","Ngày hẹn thanh toán","Thời gian lập","Thời gian cập nhật"];
    }
}

