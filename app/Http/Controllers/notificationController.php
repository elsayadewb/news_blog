<?php
namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;
use Carbon \ Carbon;
class notificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdatalastweek()
    {
       
        $notifications = Notification::select("*")

        ->whereBetween('created_at', 

                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]

            )

        ->get();



dd(startOfWeek());

 
    }
    public function index()
    {
        $notifications = Notification::Paginate(5);

        return view('notifications.index',compact('notifications'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
//  dd(request()->all());
        $data =  $request->validate([
            'type' => 'sometimes|nullable|max:150',
            'notifiable' => 'sometimes|nullable',
            'notifiable_type' => 'sometimes|nullable',
            'notifiable_id' => 'sometimes|nullable',
            'notifiable' => 'sometimes|nullable',
            'data' => 'sometimes|nullable',
            'read_at' => 'sometimes|nullable',
            'user_id' => 'sometimes|nullable',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
        ],[
            'user_id'=>'user_id',
            'type'=>'type',
            'notifiable'=>'notifiable',
            'photo'=>'photo',
            'read_at'=>'read_at',
            'data'=>'data',
            'notifiable_type'=>'notifiable_type',
            'notifiable_id'=>'notifiable_id',
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

        Notification::create($data);
        return redirect()->route('notifications.index')
            ->with('success','notification created successfully.');
    }
//  -----------------------




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
        'type' => 'sometimes|nullable',
        'notifiable' => 'sometimes|nullable|max:150',
        'data' => 'sometimes|nullable',
        'read_at' => 'sometimes|nullable',
        'user_id' => 'sometimes|nullable',
        'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ],[
    ],[

        'user_id'=>'user_id ',
        'type'=>'type',
        'data'=>'data',
        'read_at'=>'read_at',
        'user_id'=>'user_id',
        'notifiable'=>'notifiable',
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
