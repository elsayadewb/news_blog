<?php
namespace App\Http\Controllers;

use App\Models\Post;
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
        $posts = Post::Paginate(5);

        return view('posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $data =  $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'user_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
        ],[
            'user_id'=>'user_id',
            'title'=>'title',
            'description'=>'description',
            'photo'=>'photo',
        ]);

        if(request()->hasFile('photo')){
         // start image properts
            $file= request()->file('photo');
            $name = $file->getClientOriginalName() ;
            $ext  = $file->getClientOriginalExtension() ;
            $size  = $file->getSize();
            $mim  = $file->getMimeType();
            $realpath  = $file->getRealPath();
//            return $mim;
        // End   image properts
        $imageName = time().$name.'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $imageName);
        $data['photo'] ="uploads/".$imageName;
        } //end request hasFile

        Post::create($data);
        return redirect()->route('posts.index')
            ->with('success','Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }


    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:150',
            'description' => 'required',
            'photo' => 'sometimes|nullable',
        ],[
        ],[

            'user_id'=>'user_id ',
            'description'=>'description',
            'photo'=>'photo',

        ]);
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }
}
