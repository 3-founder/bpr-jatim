@extends('backend.template')

@section('extraCSS')
<!-- include libraries(jQuery, bootstrap) -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- include summernote css -->
<link href="{{ asset('') }}summernote-0.8.18-dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon fa fa-{{ $pageIcon }} icon-gradient bg-arielle-smile">
                    </i>
                </div>
                <div>
                    Tips Keamanan & Info Terkini
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{session('status')}}
                </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-times-circle"></i> {{session('error')}}
            </div>
            @endif
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {{-- <h5 class="card-title">Karier</h5> --}}
                    <form action="{{route('tips-info-terkini.update', $data->id)}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                        @include('backend.tips-info-terkini.partials.form-control')
                        <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extraJS')
<!-- include summernote js -->
<script src="{{ asset('') }}summernote-0.8.18-dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#konten').summernote({
            height: 400,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    });
    $(document).ready(function() {
        $('#konten_info').summernote({
            height: 500,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    });
</script>
@endsection