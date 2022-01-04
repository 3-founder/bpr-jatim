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
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Kebijakan Privasi</h5>
                        <form action="{{ route('kebijakan-privasi.update', $kebijakanPrivasi->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                {{-- <label for="kebijakan_privasi" class="">Kebijakan Privasi</label> --}}
                                <textarea name="kebijakan_privasi" id="getKonten" class="form-control">{{old('kebijakan_privasi', $kebijakanPrivasi->kebijakan_privasi)}}</textarea>
                                <div id="kebijakan_privasi">
                                    {!! old('kebijakan_privasi', $kebijakanPrivasi->kebijakan_privasi) !!}
                                </div>
                                {{-- <textarea name="kebijakan_privasi" class="form-control ck-editor @error('kebijakan_privasi') is-invalid @enderror">{{ old('kebijakan_privasi', $kebijakanPrivasi->kebijakan_privasi) }}</textarea> --}}
                                @error('kebijakan_privasi')
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#kebijakan_privasi', {
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
        placeholder: 'Masukkan konten disini',
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
        $('#getKonten').val(justHtml)
        console.log(justHtml);
    });

    $('#getKonten').hide();
</script>
@endsection