
@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/about-bg.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Manage Images</h1>
          <p class=""><a class="btn btn-primary" style="text-decoration: none" href="{{ route('photos.create')}}">Upload a new Photo</a></p>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="panel panel-default">
          <h5><strong>IMAGES</strong></h5>
          @if(Session::has('status'))
            <div class="alert alert-success">
              <strong>Success!</strong> {{ Session::get('status') }}
            </div>
          @endif

          @if(count($photos)== 0)
            <p>Looks like you haven't uploaded a photo, <a href="{{route('photos.create')}}">upload one now!</a></p>
          @else
          
          @foreach(array_chunk($photos, 4) as $chunk)
          <div class="card-deck">
            @foreach($chunk as $photo)
              <div class="card" style="width: 15rem;">
                <img class="card-img-top img-fluid" src="{{ url($photo['img_path']) }}" alt="Card image cap">
                <div class="card-footer secondary-bg">
                  <center><a href="#myModal{{$photo['id']}}" class="btn btn-alert main-comment-btn" value="{{ $photo['id'] }}" data-toggle="modal" >Delete</a></center>
                </div>
              </div>

              <div id="myModal{{$photo['id']}}" class="modal fade">
                <div class="modal-dialog modal-confirm">
                  <div class="modal-content">
                    <div class="modal-header">       
                      <h4 class="modal-title" style="margin-left: 23%;">Are you sure?</h4>  
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" style="padding-top: none;">
                      <p>Do you really want to delete this photo? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="{{route('photos.destroy',$photo['id'])}}">
                        {{ csrf_field()}}
                        <input type="hidden" name="_method" value="delete" />
                      <button type="button" class="btn btn-info"  data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
            @endforeach
          </div>
          <br>
          @endforeach
            
          @endif
          
        </div>
      </div>
    </div>
</div>


