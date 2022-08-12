@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 col-md-2 text-center">
                            <a href="javascript:void(0)" class="avatar avatar-md">
                                <img src="{{ url('backend-assets/assets/avatars/face-2.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </a>
                        </div>
                        <div class="col">
                            <strong class="mb-1"><span class="fe fe-user text-success fe-12 mr-2"></span>{{ $user->name
                                }}</strong>
                            <p class="small text-muted mb-1">{{ $user->email }}</p>
                        </div>
                        <div class="col-4 col-md-auto offset-4 offset-md-0 my-2">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="form-group">
                        <label for="firstname">Fullname</label>
                        <input type="text" id="name" name="name" class="form-control" disabled
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="email" name="email" disabled
                            value="{{ $user->email }}">
                    </div>
                    <hr class="my-4">
                    <div class="my-4">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <span class="fe fe-frown fe-16 mr-2"></span> Please Check your input, Something is wrong
                            there.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success notification" role="alert">
                            <span class="fe fe-smile fe-16 mr-2"></span> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Password requirements</p>
                                <p class="small text-muted mb-2"> To create a new password, you have to meet all of the
                                    following requirements: </p>
                                <ul class="small text-muted pl-4 mb-0">
                                    <li> Minimum 8 character </li>
                                    <li>At least one special character</li>
                                    <li>At least one number</li>
                                    <li>Can't be the same as a previous password </li>
                                </ul>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </form>
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    setTimeout(function () { $('.notification').hide(); }, 5000);
</script>

@endsection