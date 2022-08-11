@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="mb-2 align-items-center">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row mt-1 align-items-center">
                            <div class="col-12 col-lg-12 text-left pl-4 py-4">
                                <h2 class="h5 page-title">Welcome!</h2>
                                <span class="fe fe-user text-success fe-12 mt-2 mr-2"></span>
                                {{ $user->name }}
                                <p class="text-muted mt-2 text-justify">Website ini merupakan Lorem ipsum dolor sit
                                    amet, consectetur
                                    adipisicing elit. Debitis ullam aspernatur adipisci quam, recusandae velit beatae ad
                                    assumenda voluptates sed iure fugiat commodi ipsa hic, nemo cumque. Quaerat,
                                    excepturi numquam ab, nostrum asperiores, eligendi dolorum totam tempore autem
                                    explicabo natus fugiat optio. Veritatis excepturi id facere atque architecto cum
                                    quidem ducimus officia ad eum accusamus, autem labore tempore beatae. Minus
                                    praesentium fuga quod natus at impedit a quo. Suscipit aliquid assumenda illum sed
                                    numquam quisquam. Id dolore veritatis odit aperiam hic rerum nisi, beatae enim,
                                    culpa error corporis ducimus, nulla iste sit. Deleniti consequuntur inventore, sint
                                    iste aliquam consequatur dicta.</p>
                            </div>
                        </div>
                    </div> <!-- .card-body -->
                </div> <!-- .card -->
            </div>
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection