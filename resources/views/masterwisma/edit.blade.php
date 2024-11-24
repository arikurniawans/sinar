@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">Form Data Wisma</h4>
          </div>
          <button type="button" class="btn btn-secondary ml-auto" onclick="window.history.back();">Kembali</button>
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

             <form action="{{ route('masterwisma.update', $wisma->idwisma) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="nama_wisma">Nama Wisma:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_wisma" placeholder="Nama Wisma" value="{{ old('nama_wisma', $wisma->nama_wisma) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="alamat">Alamat:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat', $wisma->alamat) }}" required>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="pembina_wisma">Pembina Wisma:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="pembina_wisma" required>
                            <option value="">Pilih Pembina Wisma</option>
                            @foreach ($pembina as $pembinas)
                                <option value="{{ $pembinas->nama_lengkap }}" {{ old('pembina_wisma', $wisma->pembina_wisma) == $pembinas->nama_lengkap ? 'selected' : '' }}>{{ $pembinas->nama_lengkap }} - [{{ $pembinas->status == 2 ? 'Pegawai Tidak Tetap' : '-' }}]</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="supervisor">Supervisor:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="supervisor" required>
                            <option value="">Pilih Supervisor</option>
                            @foreach ($supervisor as $supervisors)
                                <option value="{{ $supervisors->nama_lengkap }}" {{ old('supervisor', $wisma->supervisor) == $supervisors->nama_lengkap ? 'selected' : '' }}>{{ $supervisors->nama_lengkap }} - [{{ $supervisors->status == 1 ? 'Pegawai Tetap' : '-' }}]</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="purna_waktu">Jumlah Tenaga Purna Waktu:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tng_purna" placeholder="Purna Waktu" value="{{ old('jumlah_tng_purna', $wisma->jumlah_tng_purna) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="part_time">Jumlah Tenaga Part Time:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tng_part" placeholder="Part Time" value="{{ old('jumlah_tng_part', $wisma->jumlah_tng_part) }}" required>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_kamar">Jumlah Kamar:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_kamar" placeholder="Jumlah Kamar" value="{{ old('jumlah_kamar', $wisma->jumlah_kamar) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_tmp_tidur">Jumlah Tempat Tidur:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tmp_tidur" placeholder="Jumlah Tempat Tidur" value="{{ old('jumlah_tmp_tidur', $wisma->jumlah_tmp_tidur) }}" required>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_anak">Jumlah Anak:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_anak" placeholder="Jumlah Anak" value="{{ old('jumlah_anak', $wisma->jumlah_anak) }}" required>
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
            // placeholder: "Pilih Supervisor",
            allowClear: true
        });
    });
</script>
 @endpush
