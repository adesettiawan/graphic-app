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
                    <p class="text-muted mt-4 text-justify">Website ini adalah Lorem ipsum dolor sit amet consectetur,
                        adipisicing
                        elit. Pariatur quibusdam in, omnis alias nihil ab laboriosam voluptatum atque distinctio, soluta
                        accusamus velit a amet tempore, rerum vitae tempora beatae eius! Cumque, explicabo. Itaque dicta
                        corporis nemo molestiae soluta omnis sequi quaerat tenetur consequatur culpa quo ex ab
                        necessitatibus porro beatae ut enim, magnam labore hic! Molestias quibusdam minima ab dolore,
                        repudiandae ducimus neque! Commodi, totam consequatur iusto error sapiente aperiam hic quia sed
                        iure tempora id placeat, tempore eveniet, esse nobis eius soluta ea itaque? Autem fugit nulla
                        voluptates eius vero doloribus, sequi aliquam nostrum distinctio accusamus vitae. Praesentium
                        commodi sed in ex ipsam vel expedita tenetur autem, hic ut, blanditiis sapiente voluptates. Odit
                        quos minima iste quaerat, hic incidunt.</p>
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection