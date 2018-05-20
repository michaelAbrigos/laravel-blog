@include('layouts.header')

<body>

@include('layouts.nav')


<header class="masthead" style="background-image: url( {{ url('/img/post-sample-image.jpg') }} )">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Registration</h1>
          <span class="subheading">You have successfully registered. An email is sent to you for verification.</span>
        </div>
      </div>
    </div>
  </div>
</header>


</body>

