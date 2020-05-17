@extends('store.layout.master')

@push('styles')
<style>
   #blog_content img {
     width: 100% !important;
   }
</style>   
@endpush

@section('content')

    @include('store.layout.component.wrap-page', ['page' => 'Bài viết'])

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 ftco-animate">
              <p>
                <img src="{{ asset('storage/'.$blog->image) }}" alt="" class="img-fluid">
              </p>
              <h2 class="mb-3">{{$blog->name}}</h2>
              <div id="blog_content">
                {!! $blog->description !!}
              </div>             
              <div class="tag-widget post-tag-container mb-5 mt-5">
                <div class="tagcloud">
                  <a href="{{ route('store.blogs', $blog->cateblog_id) }}" class="tag-cloud-link">{{$blog->blog_category->name}}</a>
                </div>
              </div>
              <div class="about-author d-flex p-4 bg-light">              
                <div class="desc">
                  <p>Ngày đăng: {{$blog->created_at->format('d/m/Y')}}</p>
                  <p>Người đăng: {{$blog->user->name}}</p>
                  <p></p>
                </div>
              </div>
    
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
              <div class="sidebar-box">
                <form action="#" class="search-form">
                  <div class="form-group">
                    <span class="fa fa-search"></span>
                    <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                  </div>
                </form>
              </div>
              <div class="sidebar-box ftco-animate">
                <div class="categories">
                  <h3>Bài viết</h3>
                  @foreach ($cate_blog as $item)
                    <li><a href="{{ route('store.blogs', $item->id) }}">{{$item->name}} <span class="fa fa-chevron-right"></span></a></li>
                  @endforeach                             
                </div>
              </div>
  
              <div class="sidebar-box ftco-animate">
                <h3>Bài viết gần đây</h3>
                @foreach ($recent_blog as $item)
                <div class="block-21 mb-4 d-flex">
                  <a class="blog-img mr-4" style="background-image: url({{Storage::url($item->image)}});"></a>
                  <div class="text">
                    <h3 class="heading"><a href="{{ route('store.blog', $item->id) }}">{{$item->name}}</a></h3>
                    <div class="meta">
                      <div><a href="{{ route('store.blog', $item->id) }}"><span class="fa fa-calendar"></span> {{$item->created_at->format('d/m/Y')}} </a></div>
                      <div><a href="{{ route('store.blog', $item->id) }}"><span class="fa fa-user"></span> {{$item->user->name}} </a></div>                     
                    </div>
                  </div>
                </div>
                @endforeach               
              </div>
              
            </div>
  
          </div>
        </div>
    </section> <!-- .section -->
@endsection