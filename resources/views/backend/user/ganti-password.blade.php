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
                {{-- <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{ $btnRight['link'] }}"><button class="btn btn-lg btn-primary"> <i
                                    class="fa fa-arrow-left mr-2"></i>{{ $btnRight['text'] }}</button></a>
                    </div>
                </div> --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <i class="fa fa-times-circle"></i> {{ session('error') }}
                    </div>
                @endif
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Ganti Password</h5>
                        <form action="{{ route('save-password', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="old_password" class="">Password Lama</label>
                                <input name="old_password" id="old_password" placeholder="Password Lama"
                                    type="password" class="form-control @error('old_password') is-invalid @enderror">
                                @error('old_password')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="new_password" class="">Password Baru</label>
                                <input name="new_password" id="new_password" placeholder="Password Baru"
                                    type="password" class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="confirm_password" class="">Kofirmasi Password Baru</label>
                                <input name="confirm_password" id="confirm_password"
                                    placeholder="Kofirmasi Password Baru" type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror">
                                @error('confirm_password')
                                    <div class="span text-danger">
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
