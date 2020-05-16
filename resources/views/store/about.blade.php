@extends('store.layout.master')

@section('content')

    @include('store.layout.component.wrap-page',['page' => 'Giới thiệu'])

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
                        <h2 class="mb-4">Giới thiệu Winemart</h2>

                        <p>Thương hiệu Winemart được thành lập vào năm 2010 với mục tiêu đem 
                            lại cho người tiêu dùng những dịch vụ và sản phẩm tốt nhất.</p>
                        <p>Winemart chuyên cung cấp các loại rượu vang, rượu mạnh, bia nhập khẩu cùng với 
                            các loại thực phẩm cao cấp khác như Chocolate, trà, cà phê, mứt, trái cây sấy khô,… 
                            từ các nhãn hiệu cao cấp, thiết kế riêng phục vụ từng đối tượng khách hàng.
                        </p>
                        <p>
                            - Lĩnh vực kinh doanh: Phân phối các nhãn hiệu rượu cao cấp.
                            Thiết kế và gói quà tết theo yêu cầu cho các doanh nghiệp và khách hàng.
                        </p>
                        <p>
                            - Sứ mệnh: Phân phối các loại rượu cao cấp và thực phẩm chất lượng có xuất xứ rõ ràng.
                        </p>
                        <p>
                            - Mục tiêu: Winemart không ngừng tìm hiểu thị trường, nắm bắt thị hiếu của người tiêu dùng,
                             luôn quan tâm chú trọng nâng cao chất lượng dịch vụ và tìm kiếm nguồn cung ứng tốt với 
                             mục tiêu đem lại cho người tiêu dùng những sản phẩm, dịch vụ tốt nhất.
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

    <section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img bg-light" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="3000">0</strong>
                            <span>Khách hàng hài lòng</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="10">0</strong>
                            <span>Năm kinh nghiệm</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="150">0</strong>
                            <span>Đơn hàng yêu cầu</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="20">0</strong>
                            <span>Nhà cung cấp</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection