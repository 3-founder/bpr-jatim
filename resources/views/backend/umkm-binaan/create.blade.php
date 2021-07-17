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
                    <h5 class="card-title">Tambah Wilayah</h5>
                <form action="{{ route('umkm-binaan.store') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="position-relative form-group">
                            <label for="name" class="">Nama</label>
                            <input name="nama" id="nama" placeholder="Nama" type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="id_kota" class="">Nama Kota</label>
                            <select name="id_kota" id="id_kota" class="form-control">
                                @foreach ($kota as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kota}} </option>
                                @endforeach
                            </select>
                            @error('id_kota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="jenis_usaha" class="">Jenis usaha</label>
                            <input name="jenis_usaha" id="nama" placeholder="Jenis usaha" type="text" class="form-control @error('jenis_usaha') is-invalid @enderror">
                            @error('jenis_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="alamat" class="">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="no_telp" class="">No. Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="deskripsi" class="">Deskripsi</label>
                            <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="foto" class="">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @error('foto')
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