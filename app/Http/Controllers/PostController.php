<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    //index page
    public function index(){
        $posts =post::orderBy('id','desc')->paginate(5);
        $count =post::count();
        return view ('posts.index',\compact('posts','count'));
    }
    //show page
    public function show($id){
        $post =Post::find($id);
        return view('posts.show',compact('post'));
    }
    //create page
    public function create(){
        return view ('posts.create');
    }
    public function store (Request $request){
        
        $request->validate([
            'title' =>'required|max:200',
            'body' =>'required|max:500',
            'coverImage'=> 'image|mimes:jpeg,bmp,png|max:1999'
            

        ]);
        if($request->hasFile('coverImage'))
        {
            $file=$request->file('coverImage');
            $ext=$file->getClientOriginalExtention();
            $filename='cover_iamge'. '_'.time().'.'. $ext;
            $path= $file->storeAs('public/coverImages',$filename);
            
        }
        else{
            $path('noimage.png');
        }
        $post =new Post();
        $post->title =$request->title;
        $post->body =$request->body;
        $post->image =$path;
        $post->user_id=auth()->user()->id;
        $post->save();
        return redirect('/posts')->with('status','post has been created !');
    }
    //edit form
    public function edit($id){
        $post =Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','you are not authorized');

        }
        return view('posts.edit',compact('post'));

    }
    //update form
    public function update(Request $request ,$id){
        $request->validate([
            'title' =>'required|max:200',
            'body' =>'required|max:500'

        ]);
        $post =post::find($id);
        $post->title= $request->title;
        $post->body= $request->body;
        $post->save();
        return redirect('/posts')->with('status','post has been updated !');

    }
    //destroy method
    public function destroy($id){
        $post =Post::find($id);
        $post->delete();
        return redirect('/posts')->with('status','post has been deleted !');
    }


}

