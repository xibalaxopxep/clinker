@extends('frontend.layouts.master')
@section('content')
<div id="mm-0" class="mm-page mm-slideout">
    <div id="page">
        <div class="sub_header_in sticky_header">
            <div class="container">
                <h1>Tiếp thị liên kết</h1>
            </div>
        </div>
        <div class="container" style="background: #fff">
            <div class="col-md-12 text-center">
                <h4 style="margin:15px 0">THÔNG TIN TÀI KHOẢN</h4>
            </div>
            <div class="col-md-12">
                <div class='row'>
                    <div class='col-md-2'>
                        <p style="font-size: 14px;margin-bottom: 8px"><strong>HỌ TÊN:</strong> </p>
                    </div>
                    <div class='col-md-10'>
                        {{Auth::guard('marketing')->user()->full_name}}
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-2'>
                        <p style="font-size: 14px;margin-bottom: 8px"><strong>MÃ CHIA SẺ LIÊN KẾT::</strong> </p>
                    </div>
                    <div class='col-md-10'>
                         {{Auth::guard('marketing')->user()->ref}}
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-2'>
                        <p style="font-size: 14px;margin-bottom: 8px"><strong>EMAIL:</strong> </p>
                    </div>
                    <div class='col-md-10'>
                        {{Auth::guard('marketing')->user()->email}}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <form method="get" action="{!!route('marketing.index',\Auth::guard('marketing')->user()->alias)!!}" class="form-inline" style="margin: 15px 0px;">
                    <div class="row" style="width: 100%">
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-md-2">Từ ngày</label>
                                <input name="start_date" class="form-control col-md-10" type="date" @if(isset($search['start_date'])) value="{{date("Y-m-d", strtotime($search['start_date']))}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-md-2">Đến ngày</label>
                                <input name="end_date" class="form-control col-md-10" type="date" @if(isset($search['end_date'])) value="{{date("Y-m-d", strtotime($search['end_date']))}}" @endif>
                            </div>
                        </div>
                        <button type="submit" class=" btn-primary" style="padding: 6px 12px;color: #333;background-color: #fff;border-color: #ccc;border-radius: 4px;border: 1px solid #ccc;">Lọc</button>

                    </div>
                </form>
            </div>
            <table class="table" style="margin-top: 30px;">
                <thead>
                    <tr role="row" class="heading">
                        <th>#</th>
                        <th>Ngày </th>
                        <th>Số đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Hoa hồng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $key=>$val)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{date("d/m/Y", strtotime($val->created_at))}}</td>
                        <td>{{$val->id}}</td>
                        <td>{{number_format($val->total)}} đ</td>
                        <td>{{number_format($val->comistion)}} đ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center">TỔNG</th>
                        
                        <th>{{number_format($total)}} đ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop