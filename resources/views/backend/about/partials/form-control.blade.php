<div class="position-relative form-group">
    <label for="judul" class="">Judul</label>
    <input name="judul" id="judul" placeholder="judul" type="text"
        class="form-control"
        value="{{old('judul', $item->judul)}}">
    @error('judul')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="position-relative form-group">
    <label for="Text Top" class="">Text Top</label>
    <textarea name="text_top" class="form-control @error('text_top') is-invalid @enderror">{{ old('text_top', $item->text_top) }}</textarea>
    @error('text_top')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="position-relative form-group">
    <label for="konten" class="">Konten</label>
    {{-- <textarea name="konten" id="konten" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $item->konten) }}</textarea> --}}
    <textarea name="konten" id="getKonten" class="form-control">{{old('konten', $item->konten)}}</textarea>
    <div id="konten">
        {!! old('konten', $item->konten) !!}
    </div>
    @error('konten')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>