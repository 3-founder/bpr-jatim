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
                        <h5 class="card-title">Edit {{ $pageTitle }}</h5>
                        <form action="{{ route('berita.update', $konten->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="id_kategori" class="">Kategori Berita</label>
                                <select name="id_kategori" id="id_kategori" class="form-control select2 @error('id_kategori') is-invalid @enderror">
                                    <option value="0">Pilih Kategori Berita</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}" {{old('id_kategori', $konten->id_kategori) == $item->id ? 'selected' : '' }} > {{ $item->kategori}} </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="judul" class="">Judul</label>
                                <input name="judul" id="judul" placeholder="Judul" type="text" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $konten->judul) }}">
                                @error('judul')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="cover" class="">Cover</label>
                                <br>
                                <img src="{{ Request::root().'/'.$konten->cover }}" alt="{{ $konten->judul }}" width="150" height="150">
                                <input name="cover" id="cover" type="file" class="form-control @error('cover') is-invalid @enderror only-image"
                                accept="image/png, image/gif, image/jpeg">
                                <span class="error-limit text-danger" style="display: none; margin-top: 0;"></span>
                                @error('cover')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="konten" class="">Konten</label>
                                <textarea name="konten" id="getKonten" class="form-control">{{ old('konten', $konten->konten) }}</textarea>
                                <div id="konten">
                                    {!! old('konten', $konten->konten) !!}
                                </div>
                                {{-- <textarea name="konten" id="konten" class="konten form-control @error('konten') is-invalid @enderror" cols="30" rows="5"></textarea> --}}
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
<!-- include summernote js -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#konten', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['link', 'image', 'video', 'formula'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                ]
            },
            placeholder: 'Masukkan konten disini',
            theme: 'snow' // or 'bubble'
        });

        quill.on('text-change', function() {
            var delta = quill.getContents();
            var text = quill.getText();
            var justHtml = quill.root.innerHTML;
            // preciousContent.innerHTML = JSON.stringify(delta);
            // justTextContent.innerHTML = text;
            // justHtmlContent.innerHTML = justHtml;
            // console.log(justHtml)
            $('#getKonten').val(justHtml)
            console.log(justHtml);
        });

        $('#getKonten').hide();
    </script>
@endsection
