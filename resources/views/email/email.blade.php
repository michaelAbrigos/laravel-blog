@include('layouts.header')

<body>


<header class="masthead" style="background-image: url( {{ url('/img/post-sample-image.jpg') }} )">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Click the Link To Verify Your Email</h1>
          <span class="subheading">Click the following link to verify your email {{url('/verifyemail/'.$email_token)}}<span>
        </div>
      </div>
    </div>
  </div>
</header>


</body>



