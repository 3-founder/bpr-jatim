<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="Judul" type="text"
        class="form-control @error('judul') is-invalid @enderror"
        value="{{old('judul')}}">
    @error('judul')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="cover" class="">Cover</label>
    <input name="cover" id="cover" type="file"
        class="form-control @error('cover') is-invalid @enderror only-image"
        accept="image/png, image/gif, image/jpeg">
    <span class="error-limit text-danger" style="display: none; margin-top: 0;"></span>
    @error('cover')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Konten</label>
    {{-- <textarea name="konten" rows="5" id="konten" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $data->konten) }}</textarea> --}}
    <textarea name="konten" id="getKonten" class="form-control">{{old('konten')}}</textarea>
    <div id="konten">
        {!! old('konten') !!}
    </div>
    @error('konten')
        <div class="span text-danger">
            {{ $message }}
        </div>
    @enderror
</div>