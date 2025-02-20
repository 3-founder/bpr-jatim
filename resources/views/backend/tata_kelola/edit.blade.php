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
                        <a href="{{ $btnRight['link'] }}"><button class="btn btn-lg btn-primary"> <i
                                    class="fa fa-arrow-left mr-2"></i>{{ $btnRight['text'] }}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit {{ $pageTitle }}</h5>
                        <form action="{{ route('tata-kelola-perusahaan.update', $laporan->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="tahun" class="">Tahun</label>
                                <input name="tahun" id="tahun" placeholder="ex: 2020" type="text"
                                    class="form-control @error('tahun') is-invalid @enderror"
                                    value="{{ old('tahun', $laporan->tahun) }}">
                                @error('tahun')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="title" class="">Judul</label>
                                <input name="title" value="{{ old('title', $laporan->title) }}" id="title"
                                    placeholder="ex: Laporan Keuangan" type="text"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="cover" class="">File cover(.jpeg/.jpg) - maks 2MB</label>
                                <br>
                                @if ($laporan->cover != null)
                                    <img src="{{ Request::root() . '/' . $laporan->cover }}" width="100"
                                        height="100"><br>
                                @endif
                                <input name="cover" id="cover" type="file" accept=".jpg,.jpeg"
                                    class="@error('cover') is-invalid @enderror">
                                @error('cover')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="laporan" class="">File Laporan(.pdf) - maks 10MB</label>
                                <br>
                                @if ($laporan->file != null)
                                    <a href="{{ Request::root() . '/' . $laporan->file }}"
                                        target="_blank">{{ $laporan->file }}</a><br>
                                @endif
                                <input name="laporan" id="laporan" type="file"
                                    class="@error('laporan') is-invalid @enderror">
                                @error('laporan')
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
