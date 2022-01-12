<?php

 namespace App\Http\Controllers;
 use Illuminate\Http\Request;

use App\Models\Comment;
 use App\Models\User;
 use App\Models\Post;

//-----------------End   Apypal Class
 class HomeController extends Controller
 {

//ُEnd  sopping cart ------------------
    public function index()
    {
        $posts    = Post::orderBy('created_at', 'DESC')->paginate(5);
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(5);
        $users    = User::orderBy('created_at', 'DESC')->paginate(5);
        return view('home', [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users,
        ]);
    }
       public function home()
    {
        $posts    = Post::orderBy('created_at', 'DESC')->paginate(5);
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(5);
        $users    = User::orderBy('created_at', 'DESC')->paginate(5);
        return view('home', [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users,
        ]);
    }
    public function dashboard()
    {
        $posts    = Post::orderBy('created_at', 'DESC')->paginate(5);
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(5);
        $users    = User::orderBy('created_at', 'DESC')->paginate(5);

        return view('dashboard',compact( 'comments','posts', 'users'));

    }

     public function store_comment(Request $request)
     {
         $data =  $request->validate([
             'title' => 'sometimes|nullable',
             'description' => 'sometimes|nullable',
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
//         return dd($data) ;
         Comment::create($data);
         return redirect()->back() ->with('success','Comment created successfully.');

     }

//
//
//     public function store_comment(Request $request)
//     {
//
//
//
//
//             $data =$this->validate(request(),[
//                 'description'        =>'required',
////                 'title'        =>'sometimes|nullable',
////                 'footer'        =>'sometimes|nullable',
////                 'product_id'        =>'sometimes|nullable',
////                 'user_id'        =>'sometimes|nullable',
////            'status_comment'        =>'required',
////            'status_comment'=> 'required|in:1,0' ,
////                 'status_comment'                 => 'required',
//
////                 'photo'                    =>'sometimes|nullable|'.v_image(),
//             ],[
//                 'description'                     =>trans('admin.description'),
////                 'title'                       =>trans('admin.title'),
////                 'product_id'                      =>trans('admin.product_id'),
////                 'user_id'                      =>trans('admin.user_id'),
////                 'footer'                      =>trans('admin.footer'),
////                 'status_comment'              =>trans('admin.status'),
////                 'photo'                       =>trans('admin.photo'),
//             ],[
//             ]);
//
////   return  dd($data);
//             Comment::Create($data);
//             session()->flash('success', 'success');
////             return back();
//
////         }//ajax
//     }






 }
