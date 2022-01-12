
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i> Back</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('posts') }}" class="btn btn-dark"> <i class="far fa-newspaper"></i>  posts</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('users') }}" class="btn btn-dark"> <i class="fa  fa-users"></i>  users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('comments') }}" class="btn btn-dark"> <i class="fa  fa-comments"></i>  comments</a></li>
        @if( url()->current() == url('/dashboard') ||  url()->current() ==  url('/') ||  url()->current() ==  url('/home') )

        @else
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url()->current().'/create'}}" class="btn btn-dark"> <i class="fa  fa-plus"></i>  create new  record </a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('') }}" class="btn btn-dark"> <i class="fas fa-home-alt"></i>  Home</a></li>

        @endif


    </ol>
</nav>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
