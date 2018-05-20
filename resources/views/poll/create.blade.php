@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Create a Poll</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
            <p>Just fill out the form to create a poll.</p>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if(Session::has('success'))
                    <div class="alert alert-success">
                      <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                @endif
            <form method="POST" action=" {{ route('pollStore') }}">
                {{ csrf_field() }}
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label for="question">Question:</label>
                        <input type="text" id="question" placeholder="Question" name="question" class="form-control" required />
                    </div>
                    <div class="option">
                        <div class="form-group floating-label-form-group controls opt">
                            <label>Option</label>
                            <input id="option_1" type="text" placeholder="Option 1" name="options[0]" class="form-control" required />
                        </div>
                        <div class="form-group floating-label-form-group controls opt">
                            <label>Option</label>
                            <input id="option_1" type="text" placeholder="Option 2" name="options[1]" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Create Poll</button>
                        </div>
                    </div>
                </div>  
            </form>
            <div style="float: right;">
            <button type="submit" class="btn btn-primary " id="add-option">Add Option</button>
            <button type="submit" class="btn btn-danger " id="remove-option">Remove Option</button>
            </div>
        </div>
    </div>


 <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
