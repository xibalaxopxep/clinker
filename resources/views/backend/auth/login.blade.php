@extends('backend.layouts.auth')
@section('content')
<div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            <!-- Login form -->
            <form class="login-form" action="{!! route('postLogin') !!}" method="post">
                {{ csrf_field() }}
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">Đăng nhập</h5>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập <i class="icon-circle-right2 ml-2"></i></button>
                        </div>

                        <div class="text-center">
                            @if(Session::has('error'))
                            <div class='alert alert-danger'>
                                <p>{!! Session::get('error') !!}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <!-- /login form -->

        </div>
        <!-- /content area -->


        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
@endsection
