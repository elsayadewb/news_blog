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
                <form action="{{ route('posts.store') }}" method="POST"   enctype="multipart/form-data">
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
                                <strong>Image:</strong>
                                <input type="file" class="form-control" accept="image/*"   name="photo" onchange="showMyImage(this)" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                @auth
                                    <input  class="form-control"     type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                @endauth
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                     <img id="thumbnil" style="width:20%; margin-top:10px;" src="{{ asset('defaultphoto.png') }}" alt="image"/>
                    <script>
                        function showMyImage(fileInput) {
                            var files = fileInput.files;
                            for (var i = 0; i < files.length; i++) {
                                var file = files[i];
                                var imageType = /image.*/;
                                if (!file.type.match(imageType)) {
                                    continue;
                                }
                                var img=document.getElementById("thumbnil");
                                img.file = file;
                                var reader = new FileReader();
                                reader.onload = (function(aImg) {
                                    return function(e) {
                                        aImg.src = e.target.result;
                                    };
                                })(img);
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

