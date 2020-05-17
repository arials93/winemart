@extends('store.layout.master')

@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endpush

@section('content')

@include('store.layout.component.wrap-page',['page' => 'Thanh toán'])

<section class="ftco-section">
    <div class="container">
        <h3 class="text-center">Đặt hàng thành công</h3>
        <p class="text-center">Cảm ơn quý khách đã tin tưởng và sử dụng sản phẩm của chúng tôi</p>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endpush
