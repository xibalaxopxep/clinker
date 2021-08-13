    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="@if(isset($config)){!!$config->keywords!!} @else  {{$share_config->keywords}} @endif" name="keywords" />
    <meta content="@if(isset($config)){!!$config->description!!} @else {{$share_config->description}} @endif " name="description" />
    <meta content="kalzen.com" name="author" />
    <meta content="@if(isset($config)){!!$config->title!!} @else  {{$share_config->title}} @endif" property="og:title" />
    <meta content="@if(isset($config)){!!$config->description!!} @else  {{$share_config->description}} @endif" property="og:description" />
    <meta property="og:image" content="">
    <meta property="og:type" content="">
    <meta property="og:title" content="@if(isset($config)){!!$config->title!!} @else  {{$share_config->title}} @endif">
    <meta property="og:url" content="">
    <meta property="og:description" content="@if(isset($config)){!!$config->description!!} @else  {{$share_config->description}} @endif">
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <!-- Document Title -->
    <title>@if(isset($config)){!!$config->title!!}  @else  {{$share_config->title}} @endif- Alagreen</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="@if(isset($config)){!!$config->favicon!!} @endif" type="image/x-icon">
    <link rel="icon" href="@if(isset($config)){!!$config->favicon!!} @endif" type="image/x-icon">
    <link rel="canonical" href="" />
    <link rel="amphtml" href="">
    <link href="{!!asset('assets/frontend/css/sweetalert.min.css')!!}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/flaticon.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/style.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/fonts/css/fontawesome-all.min.css')!!}">
    <link href="{!!asset('assets/frontend/css/font-awesome.css')!!}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/framework.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/framework-store.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/custom.css')!!}">

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
