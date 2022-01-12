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
                        <th>No</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">  <i class="far fa-eye"></i></a>
                                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">   <i class="fas fa-user-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--    {!! $data->links() !!}--}}
                {{$users->links('vendor.pagination.bootstrap-4')}}

            </div>
        </div>
    </div>
</x-app-layout>

