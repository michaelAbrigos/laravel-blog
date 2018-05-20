@extends('layouts.master')

<header class="masthead" style="background-image: url( {{ url('/img/header.jpg') }} )">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>MTICS Blog</h1>
          <span class="subheading">A Blog by BTIT-1b</span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      
      <h1>Posts</h1>
      <hr>
      @guest
      @else
        @if(count($subs) == 0)
          
          <h2 class="text-center">Recieve our newsletter!</h2>
          <p class="text-center">You will receive updates when there are new posts.</p>
          <div class="clearfix">
            <a class="btn btn-primary" href="{{ route('subscribe')}}" style="margin-left: 40%;">Subscribe <i class="fas fa-envelope" data-fa-transform="rotate--30"></i></a>
          </div>  
          <hr>
        @else
          @if(Session::has('status'))
            <div class="alert alert-success">
              <strong>Success!</strong> {{ Session::get('status') }}
            </div>
          @endif
        @endif
      @endguest
      
      @if(count($posts) == 0)
        <p>There's no posts available at the momment!</p>
      @else

        @foreach($posts as $post)
          <div class="post-preview">
            <a href="{{ route('details',$post->slug) }}">
              <h2 class="post-title">
                {{ $post->title }}
              </h2>
            </a>
            <p class="post-meta">Posted by
              <a href="{{ route('authorPost', $post->user->name)}}">{{ $post->user->name }}</a>
              on {{ $post->created_at->format('F d, Y') }}</p>
          </div>
          <hr>
        @endforeach
        
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="{{ route('oldPost') }}">Older Posts &rarr;</a>
        </div>

      @endif
      
    </div>
  </div>
</div>
