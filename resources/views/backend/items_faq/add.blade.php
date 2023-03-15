@extends('backend.template')

@section('extraCSS')
<style>
    .ck-editor__editable {
        min-height: 250px;
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
                        <h5 class="card-title">Tambah {{ $pageTitle }}</h5>
                        <form action="{{ route('items-faq.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="id_kategori" class="">Kategori FAQ</label>
                                <select name="id_kategori" id="id_kategori"
                                    class="form-control select2 @error('id_kategori') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id') == $item->id ? 'selected' : '' }}> {{ $item->nama_kategori }}
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
                                <input name="pertanyaan" value="{{ old('pertanyaan') }}" id="pertanyaan" placeholder="Pertanyaan FAQ"
                                    type="text" class="form-control @error('pertanyaan') is-invalid @enderror">
                                @error('pertanyaan')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="jawaban" class="">Jawaban</label>
                                <textarea name="jawaban" id="jawaban" class="form-control @error('jawaban') is-invalid @enderror" cols="30" rows="5">{{old('jawaban')}}</textarea>
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
