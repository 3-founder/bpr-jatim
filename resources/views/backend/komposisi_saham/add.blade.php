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
                        <form action="{{ route('komposisi-saham.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="pemilik_saham">Pemilik Saham</label>
                                <input type="text" name="pemilik_saham" class="form-control @error('pemilik_saham') is-invalid @enderror" value="{{ old('pemilik_saham') }}">
                                @error('pemilik_saham')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="jenis">Jenis</label>
                                <select name="jenis" id="" class="select2 @error('jenis') is-invalid @enderror">
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($dataJenis as $itemJenis)
                                        <option value="{{ $itemJenis }}" {{ old('jenis') == $itemJenis ? 'selected' : '' }}>{{ ucwords($itemJenis) }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="lembar">Lembar</label>
                                <input type="text" name="lembar" class="form-control rupiah @error('lembar') is-invalid @enderror" value="{{ old('lembar') }}">
                                @error('lembar')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" class="form-control rupiah @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}">
                                @error('nominal')
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

@section('extraJS')
    <script>
        $(".rupiah").keyup(function(){
            var value = $(this).val().replaceAll('.', '');
            $(this).val(formatRupiah(value));
        })

        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
        
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection