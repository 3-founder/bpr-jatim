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
                        <h5 class="card-title">Tambah {{ $pageTitle }}</h5>
                        <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="role">Role</label>
                                <input type="text" name="name" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
                                @error('role')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="Hak Akses">Hak Akses</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableHakAkses">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th><input type="checkbox" id="pilihSemua"> Pilih Semua</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPermissions as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td><input type="checkbox" name="id_permissions[]" id="hak_akses" value="{{ $item->id }}"> Pilih</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extraJS')
    <script>
        $("#pilihSemua").change(function(){
            if($(this).prop('checked')){
                $('#tableHakAkses tbody tr td input[type="checkbox"]').each(function(){
                    $(this).prop('checked', true);
                })
            } else {
                $('#tableHakAkses tbody tr td input[type="checkbox"]').each(function(){
                    $(this).prop('checked', false);
                })
            }
        })
    </script>
@endsection