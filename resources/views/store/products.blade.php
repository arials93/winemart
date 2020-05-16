@extends('store.layout.master')
@push('styles')
@endpush
    <style>
        .selectpicker {
            color: #999;
            cursor: pointer;
            background-color: #e2e6ea;
            border-color: #dae0e5;
            text-decoration: none;
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border: 1px solid transparent;
            width: 100%;
            
        }
    </style>
@section('content')

    @include('store.layout.component.wrap-page', ["page" => "Sản phẩm"])

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $item)
                        <div class="col-md-4 d-flex">
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
                        @empty
                        <div class="col-md-12 text-center">Không tìm thấy sản phẩm</div>
                        @endforelse
                    </div>
                    {{ $products->appends(request()->query())->links('vendor.pagination.store-paginate')}}
                </div>
                <div class="col-md-3">
					<div class="sidebar-box ftco-animate">
						<form class="categories" method="GET">
							<h3>Tìm kiếm sản phẩm</h3>
                            <select name="category" class="selectpicker mb-4">
                                <option value="0">Chọn loại sản phẩm</option>
                                @foreach ($subcates as $item)
                                <option {{ request()->category == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>

                            <select name="country" class="selectpicker mb-4">
                                <option value="0">Chọn quốc gia</option>
                                @foreach ($countries as $item)
                                <option {{ request()->country == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>

                            <select name="size" class="selectpicker mb-4">
                                <option value="0">Chọn dung tích</option>
                                @foreach ($sizes as $item)
                                <option {{ request()->size == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->capacity}}</option>
                                @endforeach
                            </select>

                            <select name="brand" class="selectpicker mb-4">
                                <option value="0">Chọn nhãn hiệu</option>
                                @foreach ($brands as $item)
                                <option {{ request()->brand == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>

                            <input name="name" value="{{ request()->name ?? '' }}" class="selectpicker mb-4" placeholder="Nhập tên sản phẩm"/>

                            <button class="btn btn-primary w-100" type="submit">Tìm kiếm</button>
						</form>
					</div>
				</div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
