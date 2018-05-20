@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{ asset($post->img_path) }})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1>{{$post->title}}</h1>
          <span class="meta">Posted by
            <a href="{{ route('authorPost', $post->user->name) }}">{{ $post->user->name }}</a>
            on {{ $post->created_at->format('F d, Y') }}</span>
            <ul class="share-icons-padding">
              <li class="share-text">Share this article on :</li>
              <li class="share-icons"><a href="{{ $url['facebook'] }}" target="_blank"><img src="{{asset('img/sm_share_fb.svg')}}"></a></li>
              <li class="share-icons"><a href="{{ $url['twitter'] }}" target="_blank"><img src="{{asset('img/sm_share_twt.svg')}}"></a></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
  </header>

   <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
			{!! $post->content !!}
          </div>
      </div>
  	</div>
  </article>
<br>


  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        Comments

        <form id="frm-comment">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls" style="font-size: 10px;">
                <label for="comment">Add a public comment</label>
                  <div class="row">
                    
                    <div class="col-md-10">
                      <input id="comment-field" type="text" class="form-control" placeholder="Add a public comment" name="comment">
                      <input type="hidden" id="comment_id" name="comment_id" value="0">
                      
                      @guest
                        <input type="hidden" id="user-comment" name="username" value="guest_user">
                      @else
                        <input type="hidden" id="user_id" name="user_id" value="{{ $u_id }}">
                        <input type="hidden" id="user-comment" name="username" value="{{ $user }}">
                      @endguest
                      
                      <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">

                    </div>
                    
                    <div class="col-md-2">
                      <button type="submit" disabled class="btn btn-primary main-comment-btn" value="add" id="comment-btn">Comment</button>
                    </div>

                  </div>
            </div>
          </div>
        </form>
        <br>
        
        @if(count($comments) == 0)
          <p class="main-comment-name" id="comment-section">No comments yet</p>
        @else
            <div id="comment-section">
              @foreach($comments as $comment)
                <div id="comment{{ $comment->id }}" class="numberComments comment-section">
                    
                    <div class="comment-name">
                      <div class="row">
                        <div class="col-lg-8">
                        <strong><p class="main-comment-name">
                    
                        @if($comment->user == null)
                          <i class="fas fa-user-circle"></i> Guest User <span class="text-muted" style="font-size: 10px;">{{ $comment->created_at->format('F d, Y') }}</span>
                        @else
                        <i class="fas fa-user-circle"></i> {{ $comment->user->name }} <span class="text-muted" style="font-size: 10px;">{{ $comment->created_at->format('F d, Y') }}</span>
                        @endif
                        </p></strong></div>


                        <div class="col-md-4">
                          @if($u_id == $comment->user_id)
                          <div class="comment-buttons" >
                            <button type="submit"  class="btn btn-primary main-edit-btn edit-comment" value="{{ $comment->id }}">Edit</button>
                            <button type="submit"  class="btn btn-alert main-edit-btn delete-comment" value="{{ $comment->id }}">Delete</button>
                          </div>
                          @else

                          
                          @endif
                        </div>
                      </div>
                    
                      </div>
                    <div class="comment-body">
                    <p class="main-comment" id="editCom{{$comment->id}}"> {{ $comment->comment }} </p>
                    </div>
                </div>
              @endforeach
            </div>
        
           
        @endif

      </div>
    </div>
  </div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Comment Editor</h4>
            </div>
            <div class="modal-body">
                <form id="frmReply" name="frmReply" class="form-horizontal" novalidate="">

                    <div class="form-group error">
                      <div class="form-group floating-label-form-group controls">
                        <label for="inputTask" class="col-sm-5 control-label">Edit your reply</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="reply" name="reply" placeholder="Reply" value="">
                        </div>
                      </div>
                   
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="edit-btn" value="update">Save changes</button>
                <input type="hidden" id="reply_id" name="reply_id" value="0">
                <input type="hidden" id="user-comment" name="username" value="{{ $user }}">
            </div>
        </div>
    </div>
</div>



	<meta name="_token" content="{!! csrf_token() !!}" />


  <script type="text/javascript">
    
    var btn = document.getElementById('reply-btn');
    var btn2 = document.getElementById('comment-btn');
    var commentInput = document.getElementById('reply-field');
    var mainCommentInput = document.getElementById('comment-field');
    if (commentInput) {
      commentInput.addEventListener("keyup",function(){

        if (commentInput.value.length === 0) {
          btn.disabled = true;
          //console.log(commentInput.value.length);
        }else{
          btn.disabled = false;
          //console.log(commentInput.value.length);
        }
      });
    }
    if (mainCommentInput) {
      mainCommentInput.addEventListener("keyup",function(){

        if (mainCommentInput.value.length === 0) {
          btn2.disabled = true;
          //console.log(mainCommentInput.value.length);
        }else{
          btn2.disabled = false;
          //console.log(mainCommentInput.value.length);
        }
      });
    }
  </script>

 <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection

