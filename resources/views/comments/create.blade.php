<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{--                <x-jet-welcome />--}}


                @include('message')
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Add by :</strong>
                                @php   $all_users =  App\Models\User::all()  @endphp
                                <select class="form-select form-control" name ="user_id"  aria-label="Default select example" value="{{old('user_id')}}">
                                    <option selected value="">Open this select menu</option>
                                    @foreach($all_users as $user_add)
                                        <option value="{{$user_add->id}}">{{$user_add->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>with post  :</strong>
                                @php   $all_posts =  App\Models\Post::all()  @endphp
                                <select class="form-select form-control" name ="post_id" aria-label="Default select example" value="{{old('post_id')}}  >
                                    <option selected value="" >Open this select menu</option>
                                    @foreach($all_posts as $all_post)
                                        <option value="{{$all_post->id}}"> {{$all_post->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

