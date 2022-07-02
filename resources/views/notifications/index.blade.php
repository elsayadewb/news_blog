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
                        <th>type</th>
                        <th>notifiable </th>
                        <th>photo</th>
                        <th>data</th>
                        <th>read_at</th>
                     
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($notifications as $key => $notification)
                        <tr>
 
                            <td>{{ ++$i }}</td>
                              <td>{{ $notification->type }}</td>
                              <td>{{ $notification->notifiable }}</td>
                              <td>{{ $notification->data }}</td>
                              <td>{{ $notification->read_at }}</td>
                             
                            @if($notification->photo == null)
                              <td>
                                <img src="http://cdn.onlinewebfonts.com/svg/img_370512.png" class="img-thumbnail" alt="..." style="width: 100px;  height: 90px">
                            </td>
                        @else
                        <td>
                            <img src="{{ asset($notification->photo) }}" class="img-thumbnail" alt="..." style="width: 100px;  height: 90px">
                        </td>
                        @endif
                            <td>
                                <form action="{{ route('notifications.destroy',$notification->id) }}" method="notification">
                                    <a class="btn btn-info" href="{{ route('notifications.show',$notification->id) }}">  <i class="far fa-eye"></i></a>
                                    <a class="btn btn-primary" href="{{ route('notifications.edit',$notification->id) }}">   <i class="fas fa-user-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--    {!! $data->links() !!}--}}
                {{$notifications->links('vendor.pagination.bootstrap-4')}}
             </div>
        </div>
    </div>
</x-app-layout>

