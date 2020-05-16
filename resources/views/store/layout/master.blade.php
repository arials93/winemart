<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/store/">
    <title>Liquor Store - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

    @stack('styles')
</head>

<body>

    {{-- Menu --}}
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0 phone pl-md-2">
                        <a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> 1900 636035</a>
                        <a href="#"><span class="fa fa-paper-plane mr-1"></span> marketing@winemart.vn</a>
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end">
                    <div class="social-media mr-4">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                    <div class="reg">
                        <p class="mb-0">
                            
                            @if (Auth::check())
                                <a class="mx-2" title="Thông tin cá nhân" href="{{ route('store.account.info')}}">
                                    {{Auth::user()->email}} 
                                </a>

                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>                                                            
                            @else
                                <a class="mx-2" href="{{ asset('register') }}">
                                    Đăng ký
                                </a>
                                <a href="{{ asset('login') }}">Đăng nhập</a>
                            @endif                               
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Wine<span>mart</span></a>
            <div class="order-lg-last btn-group">
                <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-shopping-bag"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>3</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url(images/prod-1.jpg);"></div>
                        <div class="text pl-3">
                            <h4>Bacardi 151</h4>
                            <p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">Quantity:
                                    01</span></p>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url(images/prod-2.jpg);"></div>
                        <div class="text pl-3">
                            <h4>Jim Beam Kentucky Straight</h4>
                            <p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity:
                                    02</span></p>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url(images/prod-3.jpg);"></div>
                        <div class="text pl-3">
                            <h4>Citadelle</h4>
                            <p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity:
                                    01</span></p>
                        </div>
                    </div>
                    <a class="dropdown-item text-center btn-link d-block w-100" href="cart.html">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/" class="nav-link">Trang chủ</a></li>
                    
                    @foreach ($menu_cates as $cate)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{$cate->name}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                @foreach ($cate->subcates as $subcate)
                                    <a class="dropdown-item" href="{{ route('store.products', $subcate->id) }}">{{$subcate->name}}</a>
                                @endforeach
                                                               
                            </div>
                        </li>
                    @endforeach
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('store.blogs', ['id' => 0]) }}" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Bài viết</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach ($menu_blogs as $blog)
                                <a class="dropdown-item" href="{{ route('store.blogs', $blog->id) }}">{{$blog->name}}</a>
                            @endforeach                        
                        </div>
                    </li>
                    <li class="nav-item"><a href="{{ asset('/about') }}" class="nav-link">Giới thiệu</a></li>
                    <li class="nav-item"><a href="{{ asset('/contact') }}" class="nav-link">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    {{-- Content --}}

    @yield('content')

    {{-- Footer --}}
    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 logo"><a href="/">Wine<span>mart</span></a></h2>
                        <p>Phân phối các loại rượu cao cấp và thực phẩm chất lượng có xuất xứ rõ ràng.</p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Tài khoản</h2>
                        <ul class="list-unstyled">
                            @if (Auth::check())
                                <li>
                                    <a title="Thông tin cá nhân" href="{{ route('store.account.info')}}">
                                        <span class="fa fa-chevron-right mr-2"></span>{{Auth::user()->email}} 
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="fa fa-chevron-right mr-2"></span>Đăng xuất
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>                                                            
                            @else
                                <li><a class="mx-2" href="{{ asset('register') }}">
                                    <span class="fa fa-chevron-right mr-2"></span>Đăng ký
                                </a></li>
                                <li><a href="{{ asset('login') }}"><span class="fa fa-chevron-right mr-2"></span>Đăng nhập</a></li>
                            @endif
                            <li><a href="{{ asset('/about') }}"><span class="fa fa-chevron-right mr-2"></span>Về chúng tôi</a></li>
                            <li><a href="{{ asset('/contact') }}"><span class="fa fa-chevron-right mr-2"></span>Liên hệ</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Chính sách giao hàng</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Chính sách đổi trả</a></li>
                        </ul>
                    </div>
                </div>
                @foreach ($menu_cates as $cate)
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2"> {{$cate->name}} </h2>
                        <ul class="list-unstyled">
                            @foreach ($cate->subcates as $item)
                             <li>
                                 <a href="{{ route('store.products',$item->id) }}">
                                <span class="fa fa-chevron-right mr-2"></span> {{$item->name}} </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Cửa hàng</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span>
                                    <span class="text">258 Phan Xích Long, P.2, Q.Phú Nhuận, TP.HCM</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">1900 636035</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                            class="text">marketing@winemart.vn</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <p class="mb-0" style="color: rgba(255,255,255,.5);">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script> Winemart <i
                                class="fa fa-heart color-danger" aria-hidden="true"></i>                           
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="js/main.js"></script>
    @stack('scripts')
</body>

</html>
