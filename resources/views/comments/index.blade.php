<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('message')

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>add by</th>
                        <th>title</th>
                        <th>descrption</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($comments as $key => $comment)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><a href="users/{{ $comment->user_id()->first()->id }} ">
                                    <i class="far fa-envelope"></i> {{ $comment->user_id()->first()->email }}
                                    <i class="far fa-user-circle"></i>{{ $comment->user_id()->first()->name }}
                                     #{{ $comment->user_id()->first()->id }}

                                </a>
                            </td>
                            <td>  @if($comment->title == null) <i class="fas fa-comment-slash"></i> add from post @else {{$comment->title}} @endif</td>
                            <td>{{ \Str::limit($comment->description, 100) }}</td>
                            <td>
                                <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('comments.show',$comment->id) }}">  <i class="far fa-eye"></i></a>
                                    <a class="btn btn-primary" href="{{ route('comments.edit',$comment->id) }}">   <i class="fas fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--    {!! $data->links() !!}--}}
                {{$comments->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</x-app-layout>

