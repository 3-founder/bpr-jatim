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
                                    <th>Nama</th>
                                    <th>Harga Beli (saat ini)</th>
                                    <th>Harga Beli (sebelumnya)</th>
                                    <th>Harga Jual (saat ini)</th>
                                    <th>Harga Jual (sebelumnya)</th>
                                    <th>Terakhir diperbarui pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $page = Request::get('page');
                                    $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                @endphp
                                @foreach ($kurs as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{ $no }}</td>
                                        <td>{{ strtoupper($item->nama) }}</td>
                                        <td class="text-center">
                                            {{ $item->harga_beli != null ? number_format($item->harga_beli, 2, '.', ',') : '0' }}
                                            <span class="fa @if($item->harga_beli > $item->temp_harga_beli) {{'fa-angle-up'}} @elseif($item->harga_beli < $item->temp_harga_beli) {{'fa-angle-down'}} @else ''  @endif"></span>
                                        </td>
                                        <td class="text-center">{{ $item->temp_harga_beli != null ? number_format($item->temp_harga_beli, 2, '.', ',') : '0' }}</td>
                                        <td class="text-center">
                                            {{ $item->harga_jual != null ? number_format($item->harga_jual, 2, '.', ',') : '0' }}
                                            <span class="fa @if($item->harga_jual > $item->temp_harga_jual) {{'fa-angle-up'}} @elseif($item->harga_jual < $item->temp_harga_jual) {{'fa-angle-down'}} @else ''  @endif"></span>
                                        </td>
                                        <td class="text-center">{{ $item->temp_harga_jual != null ? number_format($item->temp_harga_jual, 2, '.', ',') : '0' }}</td>
                                        <td class="text-center">{{ $item->updated_at }}</td>
                                        <td>
                                            <div class="form-inline">
                                                <a href="{{ route('kurs.edit', $item->id) }}" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Edit" data-placement="top"><span class="fa fa-pen"></span></button>
                                                </a>
                                                <form action="{{ route('kurs.destroy', $item->id) }}" method="post">
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
                        {{$kurs->appends(Request::all())->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
