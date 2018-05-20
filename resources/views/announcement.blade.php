@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Create an Announcement</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="panel panel-default">
                <p>Just fill out the form to email out announcements to all registered users.</p>
               
                @if(Session::has('status'))
                    <div class="alert alert-success">
                      <strong>Success!</strong> {{ Session::get('status') }}
                    </div>
                @endif
               
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="title">Title</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" size="100" placeholder="Title" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <p class="help-block text-danger"><strong>{{ $errors->first('title') }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                          <div class="form-group floating-label-form-group controls">
                            <label>Announcement</label>
                            <textarea rows="5" class="form-control" name="announcement" placeholder="Announcement" id="message"></textarea>
                            <p class="help-block text-danger"></p>
                          </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Publish
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
