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
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-user-plus mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header">List Cabang
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
                                    <th>Cabang</th>
                                    <th>Jaringan Kantor</th>
                                    <th>Jenis</th>
                                    <th>Alamat</th>
                                    <th>Kode Area</th>
                                    <th>Telepon</th>
                                    <th>Faksimile</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $page = Request::get('page');
                                    $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                @endphp
                                @foreach ($jaringanKantor as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{ $no }}</td>
                                        <td>{{ $item->kota->nama_kota }}</td>
                                        <td>{{ $item->jaringan_kantor }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->alamat != null ? $item->alamat : '-' }}</td>
                                        <td>{{ $item->kode_area != null ? $item->kode_area : '-' }}</td>
                                        <td>{{ $item->telepon != null ? $item->telepon : '-' }}</td>
                                        <td>{{ $item->fax != null ? $item->fax : '-' }}</td>
                                        <td>
                                            <div class="form-inline">
                                                <a href="{{ route('jaringan-kantor.edit', $item->id) }}" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Edit" data-placement="top"><span class="fa fa-pen"></span></button>
                                                </a>
                                                <form action="{{ route('jaringan-kantor.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-md" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
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
                        {{$jaringanKantor->appends(Request::all())->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
