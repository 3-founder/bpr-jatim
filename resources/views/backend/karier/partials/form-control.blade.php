<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="Judul" type="text"
        class="form-control @error('judul') is-invalid @enderror"
        value="{{old('judul', $data->judul)}}">
    @error('judul')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Konten</label>
    {{-- <textarea name="konten" rows="5" id="konten" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $data->konten) }}</textarea> --}}
    <textarea name="konten" id="getKonten" class="form-control">{{old('konten', $data->konten)}}</textarea>
    <div id="konten">
        {!! old('konten', $data->konten) !!}
    </div>
    @error('konten')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>