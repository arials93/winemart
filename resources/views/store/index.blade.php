@extends('store.layout.master')
@section('content')
    {{-- Slider --}}
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="mb-4">Good <span>Drink</span> <br> for <br> Good <span>Moments</span>.</h1>
                        <p>
                            <a href="#" class="btn btn-primary py-2 px-4">Mua ngay</a> 
                            <a href="#" class="btn btn-white btn-outline-white py-2 px-4">Đọc thêm</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chính sách công ty --}}
    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="text">
                            <h2>Hỗ trợ trực tuyến</h2>
                            <p>
                                Dịch vụ tư vấn 24/7 <br> Gọi ngay 1900.636.035
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-cashback"></span>
                        </div>
                        <div class="text">
                            <h2>Chính sách đổi trả</h2>
                            <p>
                                Đổi trả miễn phí trong 3 ngày
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Vận chuyển miễn phí</h2>
                            <p>
                                Đối với đơn hàng trên 500k
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Giới thiệu --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
                    style="background-image: url(images/about.jpg);">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <span class="subheading">Từ 2010</span>
                        <h2 class="mb-4">Mong muốn đáp ứng một hương vị mới</h2>

                        <p>Thương hiệu Winemart được thành lập vào năm 2010 với mục tiêu đem 
                            lại cho người tiêu dùng những dịch vụ và sản phẩm tốt nhất.</p>
                        <p>Winemart chuyên cung cấp các loại rượu vang, rượu mạnh, bia nhập khẩu cùng với 
                            các loại thực phẩm cao cấp khác như Chocolate, trà, cà phê, mứt, trái cây sấy khô,… 
                            từ các nhãn hiệu cao cấp, thiết kế riêng phục vụ từng đối tượng khách hàng.
                        </p>
                        <p class="year">
                            Với
                            <strong class="number" data-number="10">0</strong>
                            <span>năm kinh nghiệm trong kinh doanh.</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- Các loại rượu mạnh --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            @foreach ($categories as $cate)
            @if ($cate->id == 2)
                <div class="row justify-content-center pb-5">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>{{ $cate->name }}</h2>
                    </div>
                </div>
                <div class="row pb-5">
                    @foreach ($cate->subcates as $item)
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <a href="#">
                                <div class="img" style="background-image: url({{ Storage::url($item->image) }});"></div>
                            </a>
                            <h3>{{ $item->name }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
            
            @endforeach
            
        </div>
    </section>

    {{-- Rượu vang --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Sản phẩm của chúng tôi</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url({{ Storage::url($item->image) }});">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                class="flaticon-shopping-bag"></span></a>
                                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                class="flaticon-heart"></span></a>
                                        <a href="{{ route('store.product', $item->id) }}" class="d-flex align-items-center justify-content-center"><span
                                                class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                @if ($item->sale > 0)
                                    <span class="sale">Sale</span> 
                                @endif

                                @if ($item->bestseller)
                                    <span class="seller">Best Seller</span>
                                @endif
                                
                                <span class="category">{{$item->sub_category->name}}</span>
                                <h2>{{ $item->name }}</h2>

                                @if ($item->sale > 0)
                                    <p class="mb-0">
                                    <span class="price price-sale"> {{ number_format($item->price) }} VNĐ </span>
                                    <span class="price">{{ number_format($item->price - ($item->price * $item->sale / 100)) }} VNĐ</span></p>
                                @else
                                    <p class="mb-0"><span class="price">{{ number_format($item->price) }} VNĐ</span></p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                <a href="{{ route('store.products') }}" class="btn btn-primary d-block">Xem tất cả sản phẩm <span
                            class="fa fa-long-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Nhãn hiệu --}}
    <section class="ftco-section testimony-section img" style="background-image: url(images/bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <span class="subheading">Các lựa chọn cao cấp</span>
                    <h2 class="mb-3">Nhãn hiệu</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        @foreach ($brands as $brand)
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></div>
                                <div class="text">
                                    
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url({{ Storage::url($brand->image) }})"></div>
                                        <div class="pl-3">
                                            <p class="name">{{$brand->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach                     
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Bài viết --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Bài viết</span>
                    <h2>Bài viết gần đây</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($blogs as $blog)
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href=" {{ route('store.blog', $blog->id) }} " class="block-20 img"
                        style="background-image: url('{{Storage::url($blog->image)}}');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                            <p><span class="fa fa-calendar"></span>{{ $blog->created_at->format('d-m-Y') }}</p>
                            </div>
                        <h3 class="heading mb-3"><a href="{{ route('store.blog', $blog->id) }}">{{ $blog->name }}</a></h3>
                            <p>{{ $blog->sub_des }}
                            </p>
                            <a href="{{ route('store.blog', $blog->id) }}" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
