@extends('store.layout.master')

@section('content')
    
    @include('store.layout.component.wrap-page', ["page" => "Bài viết"])

    <section class="ftco-section">
        <div class="container">
          <div class="row d-flex">
            @foreach ($blogs as $blog)
            <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
              <div class="blog-entry d-md-flex">
                  <a href="{{ route('store.blog', $blog->id) }}" class="block-20 img" style="background-image: url({{ Storage::url($blog->image) }});">
              </a>
              <div class="text p-4 bg-light">
                  <div class="meta">
                      <p><span class="fa fa-calendar"></span> {{ $blog->created_at->format('d/m/Y') }} </p>
                  </div>
                <h3 class="heading mb-3">
                <a href="{{ route('store.blog', $blog->id) }}">{{ $blog->name }}</a></h3>
                <p>{{ $blog->sub_des }}</p>
                <a href="{{ route('store.blog', $blog->id) }}" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

              </div>
            </div>
          </div>
            @endforeach
          </div>
          {{ $blogs->links('vendor.pagination.store-paginate') }}
        </div>
    </div>
</section>
@endsection
