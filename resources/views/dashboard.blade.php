
@include('layouts.header')




<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {{--                <x-jet-welcome />--}}

            <section class="all_posts">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card -bg-gray-50  " >
                                <div class="-card-header">

                                    @include('message')
                                </div>
                                @foreach ($posts as $keypost => $post)
                                    <div class="card-body"  style="padding: 20px" >
                                        <h5 class="card-title">{{   $keypost.':'.  \Str::limit($post->title, 100) }}</h5>
                                        <p class="card-text">{{   $keypost.':'.  \Str::limit($post->description, 100) }}</p>
                                        <img src="https://santrikoding.com/storage/posts/TtMZketk0AUZRGmBwqVzUsAbzMdN62f3og2USjEd.png" class="card-img-top" alt="..." style="width: 100%;  height: 500px">
                                        <br/><br/>

                                        <div class="col-xs-12 col-sm-12 col-md-12" >
                                            @foreach ($comments as $key => $comment)
                                                @if($comment->post_id ==  $post->id)
                                                    <div style="border:5px dashed #777;padding: 10px">
                                                        <p><i class="fas fa-comment-dots"></i> {{   $key.':'.  \Str::limit($comment->description, 100) }}</p>
                                                    </div><br/>
                                                @endif
                                            @endforeach
                                        </div>
                                        @auth
                                            <form action="{{ url('store/comment') }}" method="POST">
                                                @csrf
                                                <div class="row ">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong>add nwe comment  :</strong>
                                                            <textarea  class="form-control" style="height:100px;border:1px dashed  #888 " name="description" placeholder="Enter Description"></textarea>
                                                            @auth
                                                                <input  class="form-control"   type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                                <input  class="form-control"     type="hidden" name="post_id" value="{{$post->id}}">
                                                            @endauth
                                                            {{--                                                <input name="user_id"   class="form-control" value="{{old('user_id')}}"  >--}}
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                        <button type="submit" class="btn btn-primary">Add comment <i class="far fa-comments"></i></button>
                                                    </div>
                                                </div>

                                            </form>
                                        @else
                                            if you want to add comment please login <a href="/login">login</a>
                                        @endauth
                                    </div>



                                @endforeach
                            </div>
                        </div><!-- col-md-12-->
                    </div><!-- row-->
                </div><!-- container-->
            </section><!--all_posts-->
        </div>
    </div>
</div>

