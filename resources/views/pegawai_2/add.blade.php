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

             <form action="{{ route('pegawai2.store') }}" method="POST">
                @csrf
                <div class="row">
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nama_lengkap">Nama Lengkap:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nomor_induk">Nomor Induk Yayasan:<span style="color: red;">*</span></label>
                      <select class="form-control select2" name="nomor_induk" required>
                        <option value="" disabled selected>Pilih Nomor Induk Yayasan</option>
                        @foreach ($nomor as $induk)
                            <option value="{{ $induk->idnomor }}">{{ $induk->nomor_yayasan }}</option>
                        @endforeach
                    </select>
                   </div>
                   <div class="form-group col-md-6">
                    <label class="form-label" for="tempat_lahir">Tempat Lahir:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                 </div>
                 <div class="form-group col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir:<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="tanggal_lahir" required>
                 </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="agama">Agama:<span style="color: red;">*</span></label>
                      <select class="form-control" name="agama" required>
                          <option value="" disabled selected>Pilih Agama</option>
                          <option value="Islam">Islam</option>
                          <option value="Kristen">Kristen</option>
                          <option value="Katolik">Katolik</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Buddha">Buddha</option>
                          <option value="Konghucu">Konghucu</option>
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="jenis_kelamin">Jenis Kelamin:<span style="color: red;">*</span></label>
                      <select class="form-control" name="jenis_kelamin" required>
                          <option value="" disabled selected>Pilih Jenis Kelamin</option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="ijazah_tahun">Ijazah/Tahun:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="ijazah_tahun" placeholder="Ijazah/Tahun" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="tahun_mulai_bekerja">Tahun Mulai Bekerja:<span style="color: red;">*</span></label>
                      <input type="date" class="form-control" name="tahun_mulai_bekerja" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="jabatan_tugas">Jabatan - Tempat Tugas:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="jabatan_tugas" placeholder="Jabatan - Tempat Tugas" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="keterangan">Keterangan:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
                   </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit Data</button>
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
