@extends('backend.template')
@section('title')
    {{ $title }}
@endsection
@php
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
    }
@endphp
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
                        Detail {{ $pageTitle }}
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
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header">{{ $pageTitle }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th class="w-25">Nama</th>
                                        <td>{{ ucwords($data->nama) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">No Telp</th>
                                        <td>{{ucwords($data->telp)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Email</th>
                                        <td>{{ucwords($data->email)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Nominal</th>
                                        <td>{{rupiah($data->nominal)}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Tenor</th>
                                        <td>{{$data->tenor}} Tahun</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Alamat</th>
                                        <td>{{$data->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Kota</th>
                                        <td>{{$data->kota}}</td>
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
