
@extends('backend.layouts.master')
@section('content')
    <div class="content">

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Thông tin liên hệ</h5>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td>
                        <h6 class="mb-0">Họ tên:</h6>
                    </td>
                    <td><span>{{$record->name}}</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="mb-0">Số điện thoại:</h6>
                    </td>
                    <td><span>{{$record->mobile}}</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="mb-0">Email:</h6>
                    </td>
                    <td><span>{{$record->email}}</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="mb-0">Tên công ty:</h6>
                    </td>
                    <td><span>{{$record->company_name}}</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="mb-0">Nội dung:</h6>
                    </td>
                    <td><span>{{$record->content}}</span></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
@stop

