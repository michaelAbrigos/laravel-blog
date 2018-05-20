<?php

namespace App\Http\Controllers;
use App\Photo;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::with('user')->where('user_id','=',Auth::id())->get()->toArray();
        return view('photos.manage',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->image);

        $validator = Validator::make($request->all(),Photo::$rules);
       // dd($validator);
        //dd($validator->fails());

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $images = $request->image;
        //dd($images);

        foreach($images as $image){
           
            //dd($images);
           
            $input['imagename'] = $image->getClientOriginalName();
            $destinationPath = public_path('/img/album');
            $imagepath = '/img/album/'.$input['imagename'];
        
             Photo::create([
                'img_path' => $imagepath,
                'user_id' => Auth::user()->id
            ]);

            $image->move($destinationPath, $input['imagename']);
        }


        return redirect('/account/photos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Photo::destroy($id);
        $photos = Photo::with('user')->where('user_id','=',Auth::id())->get()->toArray();
        return view('photos.manage',compact('photos'))->with('status','You have successfully deleted a Photo');
    }



}
