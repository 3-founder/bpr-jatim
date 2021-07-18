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
                    Detail Pengaduan Nasabah
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
                <div class="card-body">
                    <!-- Data Nasabah -->
                    <h5 class="card-title">Detail Pengaduan Nasabah</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <th class="w-25">Cabang</th>
                                    <td>{{ ucwords($data->nama_kota) }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Nama Nasabah</th>
                                    <td>{{ ucwords($data->nama) }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Tempat & Tanggal Lahir</th>
                                    <td>{{$data->tempat_lahir.', '.$data->tgl_lahir}}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Jenis Kelamin</th>
                                    <td>{{$data->jenis_kelamin}}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Jenis Identitas/Nomor Identitas</th>
                                    <td>{{$data->jenis_identitas.'/'.$data->nomor_identitas}}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Alamat</th>
                                    <td>{{$data->alamat}}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">No.Telp/No.Hp/No.Fax</th>
                                    <td>{{$data->no_telp.' / '.$data->no_hp.' / '.$data->no_fax}}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Nomor Rekening</th>
                                    <td>{{$data->no_rekening}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END Data Nasabah -->
                    <!-- Data Perwakilan -->
                <h5 class="card-title">Detail Perwakilan Nasabah</h5>
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th class="w-25">Nama</th>
                                <td>{{ ucwords($data->nama_perwakilan) }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Tempat & Tanggal Lahir</th>
                                <td>{{$data->tempat_lahir_perwakilan.', '.$data->tgl_lahir_perwakilan}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Jenis Kelamin</th>
                                <td>{{$data->jenis_kelamin_perwakilan}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Jenis Identitas/Nomor Identitas</th>
                                <td>{{$data->jenis_identitas_perwakilan.'/'.$data->nomor_identitas_perwakilan}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Alamat</th>
                                <td>{{$data->alamat_perwakilan}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">No.Telp/No.Hp/No.Fax</th>
                                <td>{{$data->no_telp_perwakilan.' / '.$data->no_hp_perwakilan.' / '.$data->no_fax_perwakilan}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- END Data Perwakilan -->
            <!-- Data Jenis Transaksi -->
            <h5 class="card-title">Jenis Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th class="w-25">Jenis Rekening</th>
                            <td>{{ ucwords($data->jenis_rekening) }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Tempat & Tanggal Lahir</th>
                            <td>{{$data->detail_pengaduan != null ? $data->detail_pengaduan : '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- END Data Jenis Transaksi -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection