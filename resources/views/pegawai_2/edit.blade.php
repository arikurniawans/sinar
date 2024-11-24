@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle}}</h4>
          </div>
          <a href="{{route('pegawai2.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
       </div>
       <div class="card-body">
          <div class="employee-info">
             @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Error:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

             <form action="{{ route('pegawai2.update', $pegawai->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nama_lengkap">Nama Lengkap:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nomor_induk">Nomor Induk Yayasan:<span style="color: red;">*</span></label>
                      <select class="form-control select2" name="nomor_induk" required>
                        <option value="" disabled>Pilih Nomor Induk Yayasan</option>
                        <option value="{{ $pegawai->idnomor }}" selected>{{ $pegawai->nomor_yayasan }}</option>
                        @foreach ($nomor as $induk)
                            <option value="{{ $induk->idnomor }}">{{ $induk->nomor_yayasan }}</option>
                        @endforeach
                    </select>
                   </div>
                   <div class="form-group col-md-6">
                    <label class="form-label" for="tempat_lahir">Tempat Lahir:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                 </div>
                 <div class="form-group col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir:<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                 </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="agama">Agama:<span style="color: red;">*</span></label>
                      <select class="form-control" name="agama" required>
                          <option value="" disabled {{ $pegawai->agama ? '' : 'selected' }}>Pilih Agama</option>
                          <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                          <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                          <option value="Katolik" {{ $pegawai->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                          <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                          <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                          <option value="Konghucu" {{ $pegawai->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="jenis_kelamin">Jenis Kelamin:<span style="color: red;">*</span></label>
                      <select class="form-control" name="jenis_kelamin" required>
                          <option value="" disabled {{ $pegawai->jenis_kelamin ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                          <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="ijazah_tahun">Ijazah/Tahun:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="ijazah_tahun" placeholder="Ijazah/Tahun" value="{{ old('ijazah_tahun', $pegawai->ijazah_tahun) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="tahun_mulai_bekerja">Tahun Mulai Bekerja:<span style="color: red;">*</span></label>
                      <input type="date" class="form-control" name="tahun_mulai_bekerja" value="{{ old('tahun_mulai_bekerja', $pegawai->tahun_mulai_bekerja) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="jabatan_tugas">Jabatan - Tempat Tugas:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="jabatan_tugas" placeholder="Jabatan - Tempat Tugas" value="{{ old('jabatan_tugas', $pegawai->jabatan_tugas) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="keterangan">Keterangan:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan', $pegawai->keterangan) }}" required>
                   </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit Perubahan Data</button>
             </form>
          </div>
       </div>
    </div>
 </div>

 @endsection


 @push('scripts')
 <script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Nomor Induk Yayasan",
            allowClear: true
        });
    });
 </script>
 @endpush
