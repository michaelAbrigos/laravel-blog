@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Add photos to your account</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="panel panel-default">
               
                @if(Session::has('status'))
                    <div class="alert alert-success">
                      <strong>Success!</strong> {{ Session::get('status') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <h5>Upload Photos</h5>
                <span class="text-muted">You can upload more than one photos</span>
               
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="control-group">
                          <div class="form-group floating-label-form-group controls">
                            <label>Photos</label>
                            <input type="file" name="image[]" multiple required>
                          </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
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
