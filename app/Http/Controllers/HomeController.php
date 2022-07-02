<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;

use App\Models\Comment;
 use App\Models\User;
 use App\Models\Post;
  use Notification;
 use App\Notifications\MyFirstNotification;
//-----------------End   Apypal Class
 class HomeController extends Controller
 {




// --------------------------------------
public function sendNotification()
    {
        $user = User::first();
  
        $details = [
            'greeting' => 'Hi Notification',
            'body' => 'This is my first notification from elsayadweb',
            'thanks' => 'Thank you for using elsayadweb !',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => 101
        ];
  
        Notification::send($user, new MyFirstNotification($details));
   
        dd('done');
    }
// --------------------------------------





//ُEnd  sopping cart ------------------
    public function index()
    {
        $posts    = Post::orderBy('created_at', 'ASC')->paginate(20);
        $comments = Comment::orderBy('created_at', 'ASC')->paginate(5);
        $users    = User::orderBy('created_at', 'ASC')->paginate(5);
        return view('home', [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users,
        ]);
    }
       public function home()
    {
        $posts    = Post::orderBy('created_at', 'ASC')->paginate(20);
        $comments = Comment::orderBy('created_at', 'ASC')->paginate(5);
        $users    = User::orderBy('created_at', 'ASC')->paginate(5);
        return view('home', [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users,
        ]);
    }
    public function dashboard()
    {
        $posts    = Post::orderBy('created_at', 'ASC')->paginate(20);
        $comments = Comment::orderBy('created_at', 'ASC')->paginate(5);
        $users    = User::orderBy('created_at', 'ASC')->paginate(5);

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




 }
