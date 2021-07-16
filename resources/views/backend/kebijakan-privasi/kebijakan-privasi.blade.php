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
                        {{ $pageTitle }}
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
                        <h5 class="card-title">Kebijakan Privasi</h5>
                        <form action="{{ route('kebijakan-privasi.update', $kebijakanPrivasi->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                {{-- <label for="kebijakan_privasi" class="">Kebijakan Privasi</label> --}}
                                <textarea name="kebijakan_privasi" class="form-control ck-editor @error('kebijakan_privasi') is-invalid @enderror">{{ old('kebijakan_privasi', $kebijakanPrivasi->kebijakan_privasi) }}</textarea>
                                @error('kebijakan_privasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
