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
                        <h5 class="card-title">Edit Jaringan Kantor</h5>
                        <form action="{{ route('jaringan-kantor.update', $jaringanKantor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="id_kota" class="">Cabang</label>
                                <select name="id_kota" id="id_kota"
                                    class="form-control select2 @error('id_kota') is-invalid @enderror">
                                    <option value="">--Cabang--</option>
                                    @foreach ($cabang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id_kota', $jaringanKantor->id_kota) == $item->id ? 'selected' : '' }}>{{ $item->nama_kota }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kota')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="jaringan_kantor" class="">Jaringan Kantor</label>
                                <input name="jaringan_kantor" id="jaringan_kantor" placeholder="Jaringan Kantor"
                                    type="text" class="form-control @error('jaringan_kantor') is-invalid @enderror" value="{{old('jaringan_kantor', $jaringanKantor->jaringan_kantor)}}">
                                @error('jaringan_kantor')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="jenis" class="">Jenis</label>
                                <select name="jenis" id="jenis"
                                    class="form-control select2 @error('jenis') is-invalid @enderror">
                                    <option value="">--Jenis--</option>
                                    <option value="KK" {{old('jenis', $jaringanKantor->jenis) == 'KK' ? 'selected' : ''}} >Kantor Kas</option>
                                    <option value="ATM" {{old('jenis', $jaringanKantor->jenis) == 'ATM' ? 'selected' : ''}} >ATM</option>
                                    <option value="MK" {{old('jenis', $jaringanKantor->jenis) == 'MK' ? 'selected' : ''}} >Mobil Keliling</option>
                                    <option value="PP" {{old('jenis', $jaringanKantor->jenis) == 'PP' ? 'selected' : ''}} >Payment Point</option>
                                </select>
                                @error('jenis')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="alamat" class="">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="5"
                                    class="form-control @error('alamat') is-invalid @enderror">{{old('alamat', $jaringanKantor->alamat)}}</textarea>
                                @error('alamat')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="kode_area" class="">Kode Area</label>
                                <input name="kode_area" id="kode_area" placeholder="Kode Area" type="number"
                                    class="form-control @error('kode_area') is-invalid @enderror" value="{{old('kode_area', $jaringanKantor->kode_area)}}">
                                @error('kode_area')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="telepon" class="">Telepon</label>
                                <input name="telepon" id="telepon" placeholder="Nomor Telepon" type="number"
                                    class="form-control @error('telepon') is-invalid @enderror" value="{{old('telepon', $jaringanKantor->telepon)}}">
                                @error('telepon')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="telp" class="">Faksimile</label>
                                <input name="fax" id="fax" placeholder="Faksimile" type="number"
                                    class="form-control @error('fax') is-invalid @enderror" value="{{old('fax', $jaringanKantor->fax)}}">
                                @error('fax')
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
