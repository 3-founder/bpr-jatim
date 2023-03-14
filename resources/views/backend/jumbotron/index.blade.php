@extends('backend.template')

@section('extraCSS')
<style>
    .jumbotron-preview {
        width: 100px;
        height: 56px;
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
            <div class="row">
                <div class="col-md-2 mb-3">
                    <a href="{{ route('jumbotrons.create') }}"><button class="btn btn-lg btn-primary"> <i class="fa fa-plus mr-2"></i>Tambah</button></a>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-header">List Jumbotron</div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @forelse ($jumbotrons as $jumbotron)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="jumbotron-preview" style="background-image: url('/{{ $jumbotron->image }}')">
                                    </div>
                                </td>
                                <td>{{ $jumbotron->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('jumbotrons.destroy', $jumbotron->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-md" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" align="center">Data masih kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$jumbotrons->appends(Request::all())->links('vendor.pagination.custom')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
