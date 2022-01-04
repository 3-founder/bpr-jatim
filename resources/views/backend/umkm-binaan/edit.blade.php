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
                    <h5 class="card-title">Update Wilayah</h5>
                <form action="{{ route('umkm-binaan.update', $UmkmBinaan->id) }}" method="POST" enctype="multipart/form-data">
                       @csrf
                       @method('PUT')
                        <div class="position-relative form-group">
                            <label for="name" class="">Nama</label>
                            <input name="nama" id="nama" placeholder="Nama" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $UmkmBinaan->nama)}}">
                            @error('name')
                                <div class="span text-danger">
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
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="jenis_usaha" class="">Jenis usaha</label>
                            <input name="jenis_usaha" id="nama" placeholder="Jenis usaha" type="text" class="form-control @error('jenis_usaha') is-invalid @enderror" value="{{old('jenis_usaha', $UmkmBinaan->jenis_usaha)}}">
                            @error('jenis_usaha')
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="alamat" class="">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{old('alamat', $UmkmBinaan->alamat)}}"</textarea>
                            @error('alamat')
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="no_telp" class="">No. Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{old('name', $UmkmBinaan->no_telp)}}">
                            @error('no_telp')
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="deskripsi" class="">Deskripsi</label>
                            <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{old('deskripsi', $UmkmBinaan->deskripsi)}}"</textarea>
                            @error('deskripsi')
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="foto" class="">Foto</label>
                            @if ($UmkmBinaan->foto != null)
                                <br><img src="{{ Request::root().'/'.$UmkmBinaan->foto }}" width="150" height="150"><br>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{old('foto', $UmkmBinaan->foto)}}">
                            
                        
                            @error('foto')
                                <div class="span text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="mt-1 btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection