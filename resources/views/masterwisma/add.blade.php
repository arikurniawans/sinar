@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle}}</h4>
          </div>
          <a href="{{route('masterwisma.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
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

             <form action="{{ route('masterwisma.store') }}" method="POST">
                @csrf
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="nama_wisma">Nama Wisma:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="nama_wisma" placeholder="Nama Wisma" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="alamat">Alamat:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="pembina_wisma">Pembina Wisma:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="pembina_wisma" required>
                            <option value="">Pilih Pembina Wisma</option>
                            @foreach ($pembina as $pembinas)
                                <option value="{{ $pembinas->nama_lengkap }}">{{ $pembinas->nama_lengkap }} - [{{ $pembinas->status == 2 ? 'Pegawai Tidak Tetap' : '-' }}]</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="supervisor">Supervisor:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="supervisor" required>
                            <option value="">Pilih Supervisor</option>
                            @foreach ($supervisor as $supervisors)
                                <option value="{{ $supervisors->nama_lengkap }}">{{ $supervisors->nama_lengkap }} - [{{ $supervisors->status == 1 ? 'Pegawai Tetap' : '-' }}]</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="purna_waktu">Jumlah Tenaga Purna Waktu:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tng_purna" placeholder="Purna Waktu" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="part_time">Jumlah Tenaga Part Time:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tng_part" placeholder="Part Time" required>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_kamar">Jumlah Kamar:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_kamar" placeholder="Jumlah Kamar" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_tmp_tidur">Jumlah Tempat Tidur:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_tmp_tidur" placeholder="Jumlah Tempat Tidur" required>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="jumlah_anak">Jumlah Anak:<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="jumlah_anak" placeholder="Jumlah Anak" required>
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
            // placeholder: "Pilih Supervisor",
            allowClear: true
        });
    });
</script>
 @endpush

