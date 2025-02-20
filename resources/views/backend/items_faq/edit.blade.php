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
                        <a href="{{ $btnRight['link'] }}"><button class="btn btn-lg btn-primary"> <i
                                    class="fa fa-arrow-left mr-2"></i>{{ $btnRight['text'] }}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Perbarui {{ $pageTitle }}</h5>
                        <form action="{{ route('items-faq.update', $itemFAQ->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="id_kategori" class="">Kategori FAQ</label>
                                <select name="id_kategori" id="id_kategori"
                                    class="form-control select2 @error('id_kategori') is-invalid @enderror">
                                    <option value="">Pilih Kategori FAQ</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id', $itemFAQ->id_kategori) == $item->id ? 'selected' : '' }}> {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="pertanyaan" class="">Pertanyaan</label>
                                <input name="pertanyaan" value="{{ old('pertanyaan', $itemFAQ->pertanyaan) }}" id="pertanyaan" placeholder="Judul FAQ"
                                    type="text" class="form-control @error('pertanyaan') is-invalid @enderror">
                                @error('pertanyaan')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="jawaban" class="">Jawaban</label>
                                <textarea name="jawaban" id="jawaban" class="form-control @error('jawaban') is-invalid @enderror" cols="30" rows="5">{{old('jawaban', $itemFAQ->jawaban)}}</textarea>
                                @error('jawaban')
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#jawaban'), {
                ckfinder: {
                    uploadUrl: '{{route('items-faq.upload').'?_token='.csrf_token()}}',
                }
            })
            .catch((err) => console.error(err));
    </script>
@endsection
