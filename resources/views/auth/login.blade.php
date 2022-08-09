@extends('auth.layouts.app')

@section('content')
<div class="row align-items-center h-100" style="margin-left: 0; margin-right: 0">
    <form action="{{ route('login_processed') }}" method="POST" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
        @csrf
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('login') }}">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
            </svg>
        </a>
        <h1 class="h6 mb-3">Sign in</h1>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control form-control-lg"
                placeholder="Email address" autofocus="" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control form-control-lg"
                placeholder="Password">
        </div>
        <div class="checkbox mb-3" style="text-align:left">
            <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Stay logged
                in </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login to your account</button>
        <p class="mt-5 mb-3 text-muted">© 2022</p>
    </form>
</div>
@endsection

@section('script')
<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "timeOut": 10000,
    }
            toastr.warning("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "timeOut": 10000,
    }
            toastr.error("{{ session('error') }}");
    @endif

    
    @if($errors->has('password'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "timeOut": 10000,
    }
            toastr.warning("{{ $errors->first('password') }}");
    @endif
    @if($errors->has('email'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "timeOut": 10000,
    }
            toastr.warning("{{ $errors->first('email') }}");
    @endif
</script>
@endsection