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
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{session('status')}}
                    </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-times-circle"></i> {{session('error')}}
                </div>
                @endif
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Profil Perusahaan</h5>
                        <form action="{{ route('profil.update', $profil->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="kantor_pusat" class="">Kantor Pusat</label>
                                <textarea name="kantor_pusat" class="form-control @error('kantor_pusat') is-invalid @enderror">{{ old('kantor_pusat', $profil->kantor_pusat) }}</textarea>
                                @error('kantor_pusat')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="facebook" class="">Facebook</label>
                                <input name="facebook" id="facebook" placeholder="Facebook" type="text"
                                    class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ old('facebook', $profil->facebook) }}">
                                @error('facebook')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="instagram" class="">Instagram</label>
                                <input name="instagram" id="instagram" placeholder="Instagram" type="text"
                                    class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ old('instagram', $profil->instagram) }}">
                                @error('instagram')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="youtube" class="">Youtube</label>
                                <input name="youtube" id="youtube" placeholder="Youtube" type="text"
                                    class="form-control @error('youtube') is-invalid @enderror"
                                    value="{{ old('youtube', $profil->youtube) }}">
                                @error('youtube')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="email" class="">Email</label>
                                <input name="email" id="email" placeholder="Email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $profil->email) }}">
                                @error('email')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="telepon1" class="">Telepon 1</label>
                                <input name="telepon1" id="telepon1" placeholder="Telepon 1" type="text"
                                    class="form-control @error('telepon1') is-invalid @enderror"
                                    value="{{ old('telepon1', $profil->telepon1) }}">
                                @error('telepon1')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="telepon2" class="">Telepon 2</label>
                                <input name="telepon2" id="telepon2" placeholder="Telepon 2" type="text"
                                    class="form-control @error('telepon2') is-invalid @enderror"
                                    value="{{ old('telepon2', $profil->telepon2) }}">
                                @error('telepon2')
                                    <div class="span text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="telepon3" class="">Telepon 3</label>
                                <input name="telepon3" id="telepon3" placeholder="Telepon 3" type="text"
                                    class="form-control @error('telepon3') is-invalid @enderror"
                                    value="{{ old('telepon3', $profil->telepon3) }}">
                                @error('telepon3')
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
