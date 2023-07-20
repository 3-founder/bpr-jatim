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
                        List {{ $pageTitle }}
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
                    <div class="card-header">List Pengajuan Kredit
                        <div class="btn-actions-pane-right">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword"
                                        value="{{ Request::get('keyword') }}" placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Calon Nasabah</th>
                                    <th>Kota</th>
                                    <th>Nominal</th>
                                    <th>Tenor</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $page = Request::get('page');
                                    $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{ $no }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nama_kota }}</td>
                                        <td>{{ rupiah($item->nominal) }}</td>
                                        <td>{{ $item->tenor }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                Sudah Ditindak Lanjuti
                                            @else
                                                Belum Ditindak Lanjuti
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-inline">
                                                <a href="{{ route('pengajuan-kredit.show', $item->id) }}" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Detail" data-placement="top"><span class="fa fa-eye"></span></button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        {{$data->appends(Request::all())->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
