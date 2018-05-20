
@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          @if(Auth::user()->is_admin == 0)
          <h1>Answer Polls</h1>
          @else
          <h1>Manage Polls</h1>
          <p class=""><a class="btn btn-primary" style="text-decoration: none" href="{{ route('pollCreate')}}">Create new Polls</a></p>
          @endif
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="panel panel-default">
          
          {{ $helper->draw($poll_id, auth()->user(),csrf_token()) }}
        

        </div>
      </div>
    </div>
</div>


@endsection