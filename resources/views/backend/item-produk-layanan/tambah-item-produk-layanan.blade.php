@extends('backend.template')

@section('extraCSS')
<!-- Include the Quill library -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #konten {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            height: 375px;
        }

        .ql-editor .ql-video {
            width: 914px !important;
            height: 514px !important;
        }

    </style>
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
                        <h5 class="card-title">Tambah Konten Produk & Layanan</h5>
                        <form action="{{ route('item-produk-layanan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="jenis" class="">Jenis Produk & Layanan</label>
                                <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                    <option value="0">Pilih Jenis</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->nama_jenis) }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="judul" class="">Judul</label>
                                <input name="judul" id="judul" placeholder="Nama Jenis Produk & Layanan" type="text" class="form-control @error('judul') is-invalid @enderror">
                                @error('judul')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="cover" class="">Cover</label>
                                <input name="cover" id="cover" type="file" class="form-control @error('cover') is-invalid @enderror">
                                @error('cover')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="deskripsi" class="">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('judul') is-invalid @enderror" cols="30" rows="5">{{old('deskripsi')}}</textarea>
                                @error('deskripsi')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="konten" class="">Konten</label>
                                <textarea name="konten" id="konten" class="form-control @error('judul') is-invalid @enderror" cols="30" rows="5">{{old('konten')}}</textarea>
                                @error('konten')
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

@section('extraJS')
<<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#konten' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection