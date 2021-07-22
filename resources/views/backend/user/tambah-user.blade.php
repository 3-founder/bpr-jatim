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
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah User</h5>
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="name" class="">Nama Lengkap</label>
                                <input name="name" id="name" placeholder="Nama Lengkap" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="email" class="">Email</label>
                                <input name="email" id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="role" class="">Role</label>
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="0">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="produklayanan">Produk & Layanan</option>
                                    <option value="berita">Berita</option>
                                    <option value="umkmbinaan">Umkm Binaan</option>
                                </select>
                                @error('role')
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
