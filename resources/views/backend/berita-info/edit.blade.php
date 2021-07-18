@extends('backend.template')

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
                    @foreach ($about as $item)
                        {{ $item->tipe}}
                    
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
                    <h5 class="card-title">{{ $item->tipe }}</h5>
                    <form action="{{route('berita-info.update', $item->id)}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                        @include('backend.berita-info.partials.form-control')
                        <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection