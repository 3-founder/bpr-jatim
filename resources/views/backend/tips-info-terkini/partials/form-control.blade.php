<h5 class="card-title">Tips Keamanan</h5>
<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul_tips" id="judul" placeholder="Judul" type="text"
        class="form-control @error('judul_tips') is-invalid @enderror"
        value="{{old('judul_tips', $data->judul_tips_keamanan)}}">
    @error('judul_tips')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Konten</label>
    <textarea name="konten" rows="5" id="konten" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $data->konten_tips_keamanan) }}</textarea>
    @error('konten')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<h5 class="card-title">Info Terkini</h5>
<div class="position-relative form-group">
    <label for="judul_info" class="">Judul</label>
    <input name="judul_info" id="judul_info" placeholder="Judul" type="text"
        class="form-control @error('judul_info') is-invalid @enderror"
        value="{{old('judul_info', $data->judul_info_terkini)}}">
    @error('judul_info')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten_info" class="">Konten</label>
    <textarea name="konten_info" rows="5" id="konten_info" class="form-control @error('konten_info') is-invalid @enderror">{{ old('konten_info', $data->konten_info_terkini) }}</textarea>
    @error('konten_info')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>