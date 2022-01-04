<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="judul" type="text"
        class="form-control"
        value="{{old('judul', $item->judul)}}">
    @error('judul')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="foto" class="">Foto</label>
    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
    @error('foto')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Konten</label>
    <textarea name="konten" class="form-control ck-editor2 @error('konten') is-invalid @enderror">{{ old('konten', $item->konten) }}</textarea>
    @error('konten')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>