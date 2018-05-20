
@extends('layouts.master')

@section('content')

<header class="masthead" style="background-image: url({{url('img/bg7.jpg')}})">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading" style="padding-bottom: 100px; padding-top: 100px;">
          <h1>Manage Posts</h1>
          <p class=""><a class="btn btn-primary" style="text-decoration: none" href="{{ route('post.create')}}">Create a new Post</a></p>
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

          @if(count($posts)== 0)
            <p>Looks like you haven't created a post, <a href="{{route('post.create')}}">create one now!</a></p>
          @else

            <table class="table-responsive">
              <thead>
                <tr class="text-center">
                  <th style="width: 60%;">Post Title</th>
                  <th>Created on</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post) 
                <tr>
                  <td style="word-wrap: break-word; padding-right: 20px;">{{ $post->title }}</td>
                  <td style="padding-right: 10px;">{{ $post->created_at }}</td>
                  <td class="text-center">
                    <a href="{{ route('post.edit',$post->id) }}">Edit</a>
                  </td>
                  <td>
                    <a href="#myModal{{$post->id}}" class="trigger-btn" data-toggle="modal">Delete</a>
                  </td>
                </tr>
                
                <div id="myModal{{$post->id}}" class="modal fade">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <div class="modal-header">       
                        <h4 class="modal-title" style="margin-left: 23%;">Are you sure?</h4>  
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body" style="padding-top: none;">
                        <p>Do you really want to delete this post? This process cannot be undone.</p>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('post.destroy',$post->id)}}">
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
              </tbody>
            </table>
          @endif
          
        </div>
      </div>
    </div>
</div>

