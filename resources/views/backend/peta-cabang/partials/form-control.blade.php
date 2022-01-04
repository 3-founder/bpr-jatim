<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="judul" type="text"
        class="form-control @error('judul') is-invalid @enderror"
        value="{{old('judul', $peta->judul)}}">
    @error('judul')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Url Peta</label>
    <textarea name="konten" rows="5" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $peta->konten) }}</textarea>
    @error('konten')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>