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
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Kurs</h5>
                        <form action="{{ route('kurs.update', $kurs->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="name" class="">Mata Uang</label>
                                <input name="name" id="name" placeholder="Nama" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $kurs->nama) }}">
                                @error('name')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="harga_beli" class="">Harga Beli</label>
                                <input name="harga_beli" id="harga_beli" placeholder="Harga Beli" type="number" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $kurs->harga_beli) }}">
                                @error('harga_beli')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="harga_jual" class="">Harga Jual</label>
                                <input name="harga_jual" id="harga_jual" placeholder="Harga Jual" type="number" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $kurs->harga_jual) }}">
                                @error('harga_jual')
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
