<?php

namespace App\Http\Controllers;
use App\Post;
use Auth;
use Share;
use Validator;
use App\Comment;
use SliderPro;
use App\Photo;
use App\Subscriber;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->image == true){
            
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img/posts');
            $imagepath = '/img/posts/'.$input['imagename'];
            $id = Auth::id();
            
            $validator = Validator::make($data = Input::all(),Post::$rules);
          
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //dd($id);
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $this->createSlug($request->title),
                'img_path' => $imagepath,
                'user_id' => Auth::user()->id
            ]);
        
            $image->move($destinationPath, $input['imagename']);

            return redirect('/account')->with('status', 'Your post has been published!');  
        }

        else{
        $id = Auth::id();
        $validator = Validator::make($data = Input::all(),Post::$rules);
      
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $this->createSlug($request->title),
            'user_id' => $id
        ]);

        return redirect('/account')->with('status', 'Your post has been published!');  
        }
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //override by another function.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($data = Input::all(), Post::$rules);
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if($request->image == true)
        {
            //dd($request);

            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);

            $image = $request->file('image');
            /////////////////////////////// changing filename to time
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            /////////////////////////////// setting dir path where to save photos (will be replaced later)
            $destinationPath = public_path('/img/posts/');
            ////////////////////////////// imagepath to be stored in the database
            $imagepath = '/img/posts/'.$input['imagename'];
            //dd($imagepath);


            $post = Post::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->img_path = $imagepath;
            $post->slug = $this->createSlug($request->title);
            $post->save();
            $image->move($destinationPath, $input['imagename']);
            return redirect('account')->with('status', 'Your post has been updated!');
        }

            $post = Post::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->slug = $this->createSlug($request->title);
            $post->save();

            return redirect('account')->with('status', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        Post::destroy($id);
        $posts = Post::with('user')->where('user_id','=',Auth::id())->get();
        return view('posts.manage',compact('posts'))->with('status','You have successfully deleted a Post');
    }

    public function listAllPosts()
    {
        
        $posts = Post::with('user')->take(4)->orderBy('created_at','desc')->get();
        
        if(!Auth::user()){

        }else{
            $subs = Subscriber::where('email',Auth::user()->email)->get();

        }
        
        return view('listPost',compact('posts','subs'));
    }

    public function getSpecificPost($slug)
    {
        $post = Post::with('user')->where('slug',$slug)->first();        
        $url = Share::load(URL::current(),$post->title)->services('facebook','twitter');
       //dd(Auth::id());

        $comments = Comment::with('post')->where('post_id','=',$post->id)->orderBy('created_at','desc')->get();

        if(Auth::check()){
            $user = Auth::user()->name;
            $u_id = Auth::id();
        }else{
            $user = "Guest_user";
            $u_id = null;
        }

        return view('postDetails',compact('post','url','comments','user','u_id'));
    }


    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function getPostByAuthors($name)
    {   
        //dd($request);
        $posts = Post::whereHas('user', function($query) use ($name){
            $query->where('name','=', $name);
        })->get();

        $photos = Photo::whereHas('user',function($query) use ($name){
            $query->where('name','=',$name);
        })->get();

        $Author = $name;
        //dd($photos);
        SliderPro::setId('my-slider');
        SliderPro::setOptions([
                'sliderOptions' => [
                    'width'  => 960,
                    'height' => 500,
                    'arrows' => true,
                    'init'   => new \Edofre\SliderPro\JsExpression("
                function() {
                    console.log('slider is initialized');
                }
            "),
        ]
    ]);
 
    

        return view('listPostByAuthors',compact('posts','Author','photos'));
    }

    public function getPostByID()
    {
        $id = Auth::id();
        $posts = Post::with('user')->where('user_id','=',$id)->get();
        
        return view('posts.manage',compact('posts'));
    }   

    public function oldPost()
    {
        $posts = Post::with('user')->orderBy('created_at','desc')->get();
        return view('olderPost',compact('posts'));
    }

    public function subscribe(){

        $sub = new Subscriber;
        $sub->email = Auth::user()->email;
        $sub->save();

        return redirect()->back()->with('status','You have successfully subscribed in our newsletter!');

    }



}
    