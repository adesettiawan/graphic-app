@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Form import data</h2>
            <p class="text-muted">Silahkan pilih file data pada form input dibawah
                ini.</p>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card shadow">
                        @if ($message = Session::get('errors'))
                        <div class="alert alert-danger notification" role="alert">
                            <span class="fe fe-frown fe-16 mr-2"></span> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                        <div class="card-body">
                            <form action="{{ route('import_processed') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        <label for="customFile">Nama file data</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file_data"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">Choose file..</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn mb-2 btn-primary" style="float: right"><span
                                                class="fe fe-upload fe-16 mr-2"></span>Upload file sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#customFile').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $('.custom-file-label').html(fileName);
        })
    })

    setTimeout(function () { $('.notification').hide(); }, 5000);
</script>

@endsection