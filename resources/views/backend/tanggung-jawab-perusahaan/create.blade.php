@extends('backend.template')

@section('extraCSS')
<!-- Include the Quill library -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
#kebijakan_privasi {
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
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{ $btnRight['link'] }}"><button class="btn btn-lg btn-primary"> <i
                                    class="fa fa-arrow-left mr-2"></i>{{ $btnRight['text'] }}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah {{ $pageTitle }}</h5>
                        <form action="{{ route('tanggung-jawab-perusahaan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="tahun" class="">Tahun</label>
                                <select name="tahun" id="" class="form-control @error('tahun') is-invalid @enderror">
                                    <?php 
                                        $thnMin = date('Y', strtotime('-10 years'));
                                        for ($i=date('Y'); $i >= $thnMin; $i--) { 
                                            $s = old('tahun')==$i ? 'selected' : '';
                                    ?>
                                        <option {{$s}}>{{$i}}</option>
                                    <?php
                                        }    
                                    ?>
                                </select>
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="title" class="">Title</label>
                                <input name="title" id="" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="laporan" class="">File Laporan(.jpeg/.jpg) - maks 10MB</label><br>
                                <input name="laporan" id="laporan" type="file" accept=".jpg,.jpeg"
                                    class="@error('laporan') is-invalid @enderror">
                                @error('laporan')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="kebijakan_privasi" class="">Artikel</label><br>
                                <textarea name="artikel" id="getArtikel" class="form-control">{{old('kebijakan_privasi')}}</textarea>
                                <div id="artikel">
                                    {!! old('artikel') !!}
                                </div>
                                @error('artikel')
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

@section('extraJS')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#artikel', {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{'size': ['small', false, 'large', 'huge']}],
                ['bold', 'italic', 'underline', 'strike'],
                ['link', 'image', 'video', 'formula'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
            ]
        },
        placeholder: 'Masukkan artikel disini',
        theme: 'snow'  // or 'bubble'
    });

    quill.on('text-change', function() {
        var delta = quill.getContents();
        var text = quill.getText();
        var justHtml = quill.root.innerHTML;
        // preciousContent.innerHTML = JSON.stringify(delta);
        // justTextContent.innerHTML = text;
        // justHtmlContent.innerHTML = justHtml;
        // console.log(justHtml)
        $('#getArtikel').val(justHtml)
        console.log(justHtml);
    });

    $('#getArtikel').hide();
</script>
@endsection