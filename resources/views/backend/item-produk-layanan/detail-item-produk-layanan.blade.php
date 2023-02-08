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
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-plus"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header">Detail Konten Produk & Layanan</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th class="w-25">Sampul</th>
                                        <td>
                                            @if ($konten->cover != null)
                                            <img src="{{ Request::root().'/public/ '.$konten->cover }}" width="200" height="200">
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Judul</th>
                                        <td>{{ucwords($konten->judul)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Jenis</th>
                                        <td>{{ucwords($konten->nama_jenis)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Deskripsi</th>
                                        <td>{{$konten->text_top}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Konten</th>
                                        <td>{!!$konten->konten!!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
