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
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="email" class="">Email</label>
                                <input name="email" id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="role" class="">Role</label>
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="0">Pilih Role</option>
                                    @foreach ($role as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                    {{--  <option value="admin">Admin</option>
                                    <option value="produklayanan">Produk & Layanan</option>
                                    <option value="berita">Berita</option>
                                    <option value="umkmbinaan">Umkm Binaan</option>  --}}
                                </select>
                                @error('role')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="password" class="">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input name="password" id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ Str::random(8) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                          <i class="fas fa-eye" id="show_eye"></i>
                                          <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
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
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endsection
