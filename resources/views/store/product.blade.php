@extends('store.layout.master')
@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endpush

@section('content')

    @include('store.layout.component.wrap-page', ['page' => 'Chi tiết sản phẩm'])    

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ Storage::url($product->image) }}" class="image-popup prod-img-bg"><img src="{{ Storage::url($product->image) }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>
                    @if ($product->sale > 0)
                        <p class="mb-0">
                        <span class="price" style="text-decoration: line-through"> {{ number_format($product->price) }} VNĐ </span>
                        <span class="price"> {{ number_format($product->price - ($product->price * $product->sale / 100)) }} VNĐ</span></p>
                    @else
                        <p class="mb-0"><span class="price">{{ number_format($product->price) }} VNĐ</span></p>
                    @endif

                    <p class="mt-3 mb-0"> <b class="text-info">Loại sản phẩm: </b>  <span>{{ $product->sub_category->name }}</span></p>
                    <p class="mb-0"> <b class="text-info">Nhãn hiệu: </b>  <span>{{ $product->brand->name }}</span></p>
                    <p class="mb-0"> <b class="text-info">Mã vạch: </b>  <span>{{ $product->barcode }}</span></p>
                    <p class="mb-0"> <b class="text-info">Nồng độ: </b>  <span>{{ $product->abv }} độ</span></p>
                    <p class="mb-0"> <b class="text-info">Năm sản xuất: </b>  <span>{{ $product->vintage }}</span></p>
                    <p class="mb-0"> <b class="text-info">Quốc gia: </b>  <span>{{ $product->country->name }}</span></p>
                    <p class="mb-0"> <b class="text-info">Dung tích: </b>  <span>{{ $product->size->capacity }} ml</span></p>

                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number"
                                value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">Còn {{ $product->instock }} sản phẩm</p>
                        </div>
                    </div>
                    <p><a href="cart.html" class="btn btn-primary py-3 px-5 mr-2">Add to Cart</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
		$(document).ready(function(){

        var max_val = {{ $product->instock }};
		var quantitiy = 0;
        $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
            if(quantity < max_val) {
                $('#quantity').val(quantity + 1);
            }

        });

            $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
            
                // Increment
                if(quantity>0){
                $('#quantity').val(quantity - 1);
                }
        });
        
    });
	</script>
@endpush
