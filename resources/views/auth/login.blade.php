@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Login</h1>
          <span class="subheading">Nice to see you again!</span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="panel panel-default">
                <p>Login now to take part in discussions again.</p>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="email">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

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
                                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <p class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
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
