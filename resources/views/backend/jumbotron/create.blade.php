@extends('backend.template')

@section('extraCSS')
<style>
    #jumbotron-preview {
        width: 250px;
        height: 141px;
        border: 1px dashed #6c757d;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: .5rem;
    }
</style>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon fa fa-{{$pageIcon}} icon-gradient bg-arielle-smile">
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
            <div class="main-card mb-3 card">
                <div class="card-header">Add Jumbotron</div>
                <div class="card-body">
                    <form action="{{ route('jumbotrons.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-file mb-3">
                                    <input type="file" name="image" id="image" class="custom-file-input" accept="image/*">
                                    <label for="image" class="custom-file-label">Pilih file (.jpg/.png) - maksimal {{ ini_get('upload_max_filesize') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div id="jumbotron-preview" class="d-flex justify-content-center align-items-center">
                                    <span>Preview</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extraJS')
<script>
    $('#image').change(function() {
        const file = this.files[0];

        if(file) {
            let reader = new FileReader();
            reader.onload = (event) => {
                $('#jumbotron-preview').attr('style', `background-image: url('${event.target.result}');`);
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
