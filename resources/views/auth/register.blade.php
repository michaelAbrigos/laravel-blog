@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/contact-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Register</h1>
          <span class="subheading">Register now and be a part of the discussions.</span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row ">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="panel panel-default">
                <p>Hey! Go ahead and create an account inorder for you to take part in discussions. We'll be waiting for you!</p>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="name">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <p class="help-block text-danger"><strong>{{ $errors->first('name') }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="email">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <p class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="password">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required>
                                    @if ($errors->has('password'))
                                        <p class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="password-confirm">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password-confirm') }}" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
