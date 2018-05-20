
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
          <h1><strong>Polls</strong></h1>
          <hr>  
          @if(Session::has('status'))
            <div class="alert alert-success">
              <strong>Success!</strong> {{ Session::get('status') }}
            </div>
          @endif
            
          @foreach($polls as $poll)
          <div class="row">
            <div class="post-preview col-lg-8">
            <a href="{{route('viewPoll',$poll->id)}}">
              <h2 class="post-title">
                {{ $poll->question }}
              </h2>
            </a>
            </div>
            <div class="col-lg-2">
              @if(Auth::user()->is_admin == 0)
                  
            @else
            <div class="post-preview">
                @if($poll->isClosed == 0)
                <a href="{{route('lockPoll',$poll->id)}}"><h4 class="post-title manage-links">
                  Lock
                @else
                <a href="{{route('unlockPoll',$poll->id)}}"><h4 class="post-title manage-links">
                  Unlock
                @endif
              </h4></a>
            </div>
            @endif
            </div>
            <div class="col-lg-2">
              @if(Auth::user()->is_admin == 0)
                  
            @else
            <div class="post-preview">
              <a href="#myModal{{$poll->id}}" class="trigger-btn" data-toggle="modal"><h4 class="post-title manage-links">Delete</h4></a>
            </div>
            @endif
            </div>
          </div>
          
          <hr>

          <div id="myModal{{$poll->id}}" class="modal fade">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <div class="modal-header">       
                        <h4 class="modal-title" style="margin-left: 23%;">Are you sure?</h4>  
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body" style="padding-top: none;">
                        <p>Do you really want to delete this poll? This process cannot be undone.</p>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('deletePoll',$poll->id)}}">
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
      </div>
    </div>
</div>


@endsection