@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url( {{ url('/img/post-sample-image.jpg') }} )">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>{{$Author}}'s profile</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <h4>Images</h4>
      <div class="container">
        <div class="slider-pro" id="my-slider">
            <div class="sp-slides">
                @foreach($photos as $photo)
                <div class="sp-slide">
                    <img class="sp-image" src="{{url($photo->img_path)}}"/>
                </div>
                @endforeach

                
                <div class="sp-thumbnails">
                  @foreach($photos as $photo)
                    <img class="sp-thumbnail" src="{{url($photo->img_path)}}" data-src="{{url($photo->img_path)}}"/>
                  @endforeach
                </div>
            </div>
        </div>
<?= SliderPro::generate(false);?>
<hr>
      @foreach($posts as $post)
      <div class="post-preview">
        <a href="{{ route('details',$post->slug) }}">
          <h2 class="post-title">
            {{ $post->title }}
          </h2>
        </a>
        <p class="post-meta">Posted by
          <a href="">{{ $post->user->name }}</a>
          on {{ $post->created_at->format('F d, Y') }}</p>
      </div>
      <hr>
      @endforeach
      
    </div>
  </div>
</div>


@endsection