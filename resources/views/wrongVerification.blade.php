@include('layouts.header')

<body>

@include('layouts.nav')


<header class="masthead" style="background-image: url( {{ url('/img/post-sample-image.jpg') }} )">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Oops this doesn't let you verify your email!</h1>
          <span class="subheading">If you want you can resend the email verification. Click here to <a href="{{url('/login')}}">Resend</a></span>
        </div>
      </div>
    </div>
  </div>
</header>


</body>