<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $posts=Post::orderBy('created_at','desc')->Paginate(4);

//        $posts->path="https://blogsitestore.s3.ap-south-1.amazonaws.com";
//       if (!empty($posts) && Storage::disk('s3')->url($posts->cover_image))
//        {
//        $path= response(Storage::disk('s3')->get($posts->cover_image))->header('Content-Type','image/jpeg');
//       } 
//       else {
//            $path="no image";
//    }

$path="https://blogsitestore.s3.ap-south-1.amazonaws.com";
$data=array("posts"=>$posts,"path"=>$path);


      return view('posts.index')->with($data);

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
    $this->validate($request,[
'posttitle'=>'required',
'postbody'=>'required',
'cover_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:15000'
    ]);
$post=new Post();
$post->title=$request->input('posttitle');
$post->body=$request->input('postbody');
$post->user_id=auth()->user()->id;

if($request->hasFile('cover_image'))
{
$filenameWithExt=$request->file('cover_image')->getClientOriginalName();
$filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
$extension=$request->file('cover_image')->getClientOriginalExtension();
$filenameToStore=$filename.'_'.time().'.'.$extension;

//$path=$request->file('cover_image')->storeAs('/public/cover_images',$filenameToStore);
Storage::disk('s3')->put($filenameToStore, fopen($request->file('cover_image'), 'r+'), 'public');

}
else
{
    $filenameToStore='noimage.jpg';
}
$post->cover_image=$filenameToStore;
$post->save();
return redirect('/posts')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post=Post::find($id);
        $path="https://blogsitestore.s3.ap-south-1.amazonaws.com";
$data=array("post"=>$post,"path"=>$path);


          return view ('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post=Post::find($id);

       if(auth()->user()->id!==$post->user_id)
       {
           return redirect ('/posts')->with('error','unauthorised page');
       }
       return view('posts.edit')->with('post',$post);
    
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
        $this->validate($request,[
            'posttitle'=>'required',
            'postbody'=>'required' ,
            'cover_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg,mp4|max:15000'
                ]);
            $post= Post::find($id);
            $post->title=$request->input('posttitle');
            $post->body=$request->input('postbody');
           

            if($request->hasFile('cover_image'))
            {
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore=$filename.'_'.time().'.'.$extension;
            
           // $path=$request->file('cover_image')->storeAs('/public/cover_images',$filenameToStore);
           Storage::disk('s3')->put($filenameToStore, fopen($request->file('cover_image'), 'r+'), 'public');    
        }
            else
            {
                $filenameToStore='noimage.jpg';
            }
            $post->cover_image=$filenameToStore;
            $post->save();
            return redirect('/posts')->with('success','Post updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $post=Post::find($id);
    if(auth()->user()->id!==$post->user_id)
    {
        return redirect ('/posts')->with('error','unauthorised page');
 }
    $post->delete();
    return redirect('/posts')->with('success','Post deleted Successfully');

    }
}
