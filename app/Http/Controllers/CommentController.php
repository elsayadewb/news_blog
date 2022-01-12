<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::Paginate(5);

        return view('comments.index',compact('comments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
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
            'post_id' => 'required',
             'photo' => 'sometimes|nullable',
         ],[
        ],[

            'title'=>'title',
            'description'=>'description',
            'photo'=>'photo',
            'user_id'=>'user_id',
            'post_id'=>'post_id',

        ]);
//        return dd($data);
        Comment::create($data);
        return redirect()->route('comments.index') ->with('success','Comment created successfully.');

    }


    public function show(Comment $comment)
    {
        return view('comments.show',compact('comment'));
    }


    public function edit(Comment $comment)
    {
        return view('comments.edit',compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'photo' => 'sometimes|nullable',
            'user_id' => 'required',
            'post_id' => 'required',
        ],[
        ],[

            'title'=>'title ',
            'description'=>'description',
            'photo'=>'photo',
            'user_id'=>'user_id',
            'post_id'=>'post_id',
        ]);

        $comment->update($request->all());

        return redirect()->route('comments.index')
            ->with('success','Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')
            ->with('success','Comment deleted successfully');
    }
}
