<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{!!$share_config->description!!}">
<meta name="author" content="Ansonika">
<title>{!!$share_config->title!!}</title>

<!-- Favicons-->
<link rel="shortcut icon" href="{{$share_config->favicon}}" type="image/x-icon">
<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

<link rel="canonical" href="{{url()->current()}}" />
<meta property="og:type" content="website" />
<meta name="keywords" content="@if(isset($config)){{$config->keywords}} @else {{$share_config->keywords}} @endif" itemprop="keywords" >
<meta name="description" content="@if(isset($config)){{$config->description}} @else {{$share_config->description}} @endif" >
<meta property="og:title" content="@if(isset($config)) @if($config->meta_title){{$config->meta_title}} @else {{$config->title}} @endif @else {{$share_config->title}} @endif"  />
<meta property="og:description" content="@if(isset($config))@if($config->meta_description){{$config->meta_description}} @else {{$config->description}} @endif @else {{$share_config->description}} @endif"/>
<meta property="og:image" content="@if(isset($product)){{asset($product->getImage())}} @elseif(isset($blog)){{asset($blog->getImage())}} @elseif(isset($config)) {{$config->getImage()}} @else '' @endif" />
<meta property="og:url" content="{{url()->current()}}" />
<!-- GOOGLE WEB FONT -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" as="fetch" crossorigin="anonymous">
<script type="text/javascript">
    !function (e, n, t) {
        "use strict";
        var o = "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap", r = "__3perf_googleFonts_c2536";
        function c(e) {
            (n.head || n.body).appendChild(e)
        }
        function a() {
            var e = n.createElement("link");
            e.href = o, e.rel = "stylesheet", c(e)
        }
        function f(e) {
            if (!n.getElementById(r)) {
                var t = n.createElement("style");
                t.id = r, c(t)
            }
            n.getElementById(r).innerHTML = e
        }
        e.FontFace && e.FontFace.prototype.hasOwnProperty("display") ? (t[r] && f(t[r]), fetch(o).then(function (e) {
            return e.text()
        }).then(function (e) {
            return e.replace(/@font-face {/g, "@font-face{font-display:swap;")
        }).then(function (e) {
            return t[r] = e
        }).then(f).catch(a)) : a()
    }(window, document, localStorage);
</script>

<!-- BASE CSS -->
<link href="{!!asset('assets/frontend/css/bootstrap.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/font-awesome.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/owl.carousel.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/owl.theme.default.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/sweetalert.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/bootstrap.min.css')!!}" rel="stylesheet">
<link rel="stylesheet" href="{!!asset('assets/frontend/css/nice-select.css')!!}">

<link href="{!!asset('assets/frontend/css/style.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/blog.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/custom.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/vendors.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/jquery.auto-complete.min.css')!!}" rel="stylesheet">


<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11097556-8']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155240324-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155240324-1');
</script>
