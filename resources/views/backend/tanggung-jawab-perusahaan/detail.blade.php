@extends('backend.template')
@section('title')
    {{ $title }}
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
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header">Detail Berita</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th class="w-25">Kategori Berita</th>
                                        <td>{{ucwords($konten->kategori->kategori)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Judul</th>
                                        <td>{{ucwords($konten->judul)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Sampul</th>
                                        <td>
                                            <img src="{{ asset('../'.$konten->cover) }}" alt="{{ $konten->judul }}" class="img-thumbnail">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="w-25">Konten</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {!!$konten->konten!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
