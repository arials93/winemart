@extends('store.layout.master')

@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endpush

@section('content')

@include('store.layout.component.wrap-page',['page' => 'Giỏ hàng'])

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="table-wrap">
                <table class="table">
                    <thead class="thead-primary">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>&nbsp;</th>
                            <th>Tổng tiền</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach ($data as $item)
						<tr class="alert" role="alert">
                            <td>
                                <div class="img" style="background-image: url({{ Storage::url($item->associatedModel->image) }});"></div>
                            </td>
                            <td>
                                <div class="email">
									<span>{{ $item->name }}</span>
                                    <span></span>
                                </div>
                            </td>
                            <td>
								<p class="mb-0"><span class="price">{{ number_format($item->price) }} VNĐ</span></p>
							</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="text" name="quantity" data-row-id="{{$item->id}}" class="quantity form-control input-number"
								value="{{ $item->quantity }}" min="1" max="{{ $item->associatedModel->instock }}">
                                </div>
                            </td>
						<td id="product_cart_{{$item->id}}">{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                            <td>
							<button type="button" class="close" data-row-id="{{$item->id}}" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Tổng thanh toán</h3>
                    <p class="d-flex">
                        <span>Phí giao hàng</span>
                        <span>0 VND</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Tổng</span>
						<span id="cart-total">{{number_format(\Cart::getTotal())}} VND</span>
                    </p>
                </div>
			<p class="text-center"><a href="{{route('store.checkout')}}" class="btn btn-primary py-3 px-4">Thanh toán</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
	$('td').delegate('.close', 'click', function() {
		var target = $(this);
		var row_id = target.attr('data-row-id');
		$.ajax({
			method: "POST",
			url: "/cart/delete/" + row_id,
		}).done(function(res) {
			$('#cart-total').html(res.total.toLocaleString() + ' VND');
            get_cart();
		});
	});

	$('.quantity').on('input', function(e) {
		var target = $(e.target);
		var quantity = target.val();
		if (quantity && !isNaN(quantity)) {
			var row_id = target.attr('data-row-id');
			$.ajax({
				method: "POST",
				url: "/cart/update/" + row_id,
				data: {'quantity': parseInt(quantity)},
			}).done(function(res) {
				$('#cart-total').html(res.total.toLocaleString() + ' VND');
				$('#product_cart_' + row_id).html(res.product_total.toLocaleString() + ' VND');
                get_cart();
			});
		}
	});
</script>
@endpush
