@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle}}</h4>
          </div>
          <a href="{{route('databinaan.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
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

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

             <form action="{{ route('databinaan.update', $databinaan->idbinaan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nama_lengkap">Nama:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama', $databinaan->nama) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nik">NIK:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{ old('nik', $databinaan->nik) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="no_kk">No KK:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="no_kk" placeholder="No KK" value="{{ old('no_kk', $databinaan->no_kk) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="tempat_lahir">Tempat Lahir:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $databinaan->tempat_lahir) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="tanggal_lahir">Tanggal Lahir:<span style="color: red;">*</span></label>
                      <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $databinaan->tanggal_lahir) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="jenis_kelamin">Jenis Kelamin:<span style="color: red;">*</span></label>
                      <select class="form-control" name="jenis_kelamin" required>
                          <option value="" disabled {{ old('jenis_kelamin', $databinaan->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                          <option value="Laki-laki" {{ old('jenis_kelamin', $databinaan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ old('jenis_kelamin', $databinaan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="alamat_ktp">Alamat KTP:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="alamat_ktp" placeholder="Alamat KTP" value="{{ old('alamat_ktp', $databinaan->alamat_ktp) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="rt">RT:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="rt" placeholder="RT" value="{{ old('rt', $databinaan->rt) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="rw">RW:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="rw" placeholder="RW" value="{{ old('rw', $databinaan->rw) }}" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nama_prop">Nama Provinsi:<span style="color: red;">*</span></label>
                      <select class="form-control select2" name="nama_props" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                          @foreach($provinces as $province)
                              <option value="{{ $province->id }}" {{ old('nama_props', $databinaan->idprov) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                          @endforeach
                      </select>
                      <input type="hidden" class="form-control" name="nama_prop" id="nama_prop" value="{{ old('nama_prop', $databinaan->nama_prop) }}" required>
                      <input type="hidden" class="form-control" name="idprov" id="idprov" value="{{ old('idprov', $databinaan->idprov) }}" required>
                   </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="nama_kabkot">Nama Kab/Kota:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="nama_kabkots" id="nama_kabkots" required>
                            <option value="{{$databinaan->idkabkot}}" {{ old('nama_kabkot', $databinaan->nama_kabkot) ? '' : 'selected' }}>{{$databinaan->nama_kabkot}}</option>
                        </select>
                        <input type="hidden" class="form-control" name="nama_kabkot" id="nama_kabkot" value="{{ old('nama_kabkot', $databinaan->nama_kabkot) }}" required>
                        <input type="hidden" class="form-control" name="idkabkot" id="idkabkot" value="{{ old('idkabkot', $databinaan->idkabkot) }}" required>
                    </div>
                     <div class="form-group col-md-6">
                        <label class="form-label" for="nama_kec">Nama Kecamatan:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="nama_kecs" id="nama_kecs" required>
                            <option value="{{$databinaan->idkec}}" {{ old('nama_kec', $databinaan->nama_kec) ? '' : 'selected' }}>{{$databinaan->nama_kec}}</option>
                        </select>
                        <input type="hidden" class="form-control" name="nama_kec" id="nama_kec" value="{{ old('nama_kec', $databinaan->nama_kec) }}" required>
                        <input type="hidden" class="form-control" name="idkec" id="idkec" value="{{ old('idkec', $databinaan->idkec) }}" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label class="form-label" for="nama_kel">Nama Kelurahan:<span style="color: red;">*</span></label>
                        <select class="form-control select2" name="nama_kels" id="nama_kels" required>
                            <option value="{{$databinaan->idkel}}" {{ old('nama_kel', $databinaan->nama_kel) ? '' : 'selected' }}>{{$databinaan->nama_kel}}</option>
                        </select>
                        <input type="hidden" class="form-control" name="nama_kel" id="nama_kel" value="{{ old('nama_kel', $databinaan->nama_kel) }}" required>
                        <input type="hidden" class="form-control" name="idkel" id="idkel" value="{{ old('idkel', $databinaan->idkel) }}" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label class="form-label" for="dusun">Dusun:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="dusun" placeholder="Dusun" value="{{ old('dusun', $databinaan->dusun) }}" required>
                     </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="ragam_disabilitas">Ragam Disabilitas:<span style="color: red;">*</span></label>
                      <select class="form-control select2" name="ragam_disabilitas" required>
                        @foreach ($kasus as $disabilitas)
                            <option value="{{ $disabilitas->idkasus }}"
                                {{ in_array($disabilitas->idkasus, is_array(old('ragam_disabilitas', $databinaan->ragam_disabilitas))
                                    ? old('ragam_disabilitas', $databinaan->ragam_disabilitas)
                                    : [old('ragam_disabilitas', $databinaan->ragam_disabilitas)])
                                    ? 'selected' : '' }}>
                                {{ $disabilitas->kode }} - {{ $disabilitas->namakasus }}
                            </option>
                        @endforeach
                      </select>
                      <small class="form-text text-muted">Pilih satu atau lebih ragam disabilitas.</small>
                   </div>
                   <div class="form-group col-md-6">
                    <label class="form-label" for="wisma">Wisma:<span style="color: red;">*</span></label>
                    <select class="form-control select2" name="wisma" required>
                        <option value="" disabled selected>Pilih Wisma</option>
                        @foreach ($wisma as $dtwisma)
                            <option value="{{ $dtwisma->idwisma }}" {{ old('wisma', $databinaan->wisma) == $dtwisma->idwisma ? 'selected' : '' }}>{{ $dtwisma->nama_wisma }}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="foto">Foto:</label>
                      <input type="file" class="form-control" name="foto" accept=".jpg,.jpeg,.png">
                      <small class="form-text text-muted">Hanya gambar (jpg, jpeg, png) dengan ukuran maksimal 2MB yang dapat diunggah.</small>
                   </div>
                   <div class="form-group col-md-6">
                      <label class="form-label" for="keterangan">Keterangan:</label>
                      <input type="text" class="form-control" name="keterangan" placeholder="Masukkan keterangan di sini" value="{{ old('keterangan', $databinaan->keterangan) }}">
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
            allowClear: true
        });

        // Ambil data kabupaten/kota berdasarkan provinsi yang dipilih
        $('select[name="nama_props"]').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                axios.get(`{{ route('databinaan.kabkota', '') }}/${provinceId}`, {
                    withCredentials: true
                })
                    .then(function(response) {
                        var kabkotSelect = $('#nama_kabkots');
                        kabkotSelect.empty();
                        kabkotSelect.append('<option value="" disabled selected>Pilih Kab/Kota</option>');
                        response.data.forEach(function(kabkot) {
                            kabkotSelect.append(`<option value="${kabkot.id}">${kabkot.name}</option>`);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching kabupaten/kota:', error);
                        // alert('Terjadi kesalahan saat mengambil data kabupaten/kota. Silakan coba lagi.');
                    });
            } else {
                $('#nama_kabkots').empty();
                $('#nama_kabkots').append('<option value="" disabled selected>Pilih Kab/Kota</option>');
            }
        });

        $('select[name="nama_kabkots"]').change(function() {
            var kabkotId = $(this).val();
            if (kabkotId) {
                axios.get(`{{ route('databinaan.kecamatan', '') }}/${kabkotId}`, {
                    withCredentials: true
                })
                    .then(function(response) {
                        var kecSelect = $('#nama_kecs');
                        kecSelect.empty();
                        kecSelect.append('<option value="" disabled selected>Pilih Kecamatan</option>');
                        response.data.forEach(function(kecamatan) {
                            kecSelect.append(`<option value="${kecamatan.id}">${kecamatan.name}</option>`);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching kecamatan:', error);
                        // alert('Terjadi kesalahan saat mengambil data kecamatan. Silakan coba lagi.');
                    });
            } else {
                $('#nama_kecs').empty();
                $('#nama_kecs').append('<option value="" disabled selected>Pilih Kecamatan</option>');
            }
        });

        $('select[name="nama_kecs"]').change(function() {
            var kecId = $(this).val();
            if (kecId) {
                axios.get(`{{ route('databinaan.kelurahan', '') }}/${kecId}`, {
                    withCredentials: true
                })
                    .then(function(response) {
                        var kelSelect = $('#nama_kels');
                        kelSelect.empty();
                        kelSelect.append('<option value="" disabled selected>Pilih Kelurahan</option>');
                        response.data.forEach(function(kelurahan) {
                            kelSelect.append(`<option value="${kelurahan.id}">${kelurahan.name}</option>`);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching kelurahan:', error);
                        // alert('Terjadi kesalahan saat mengambil data kelurahan. Silakan coba lagi.');
                    });
            } else {
                $('#nama_kels').empty();
                $('#nama_kels').append('<option value="" disabled selected>Pilih Kelurahan</option>');
            }
        });

        $('select[name="nama_props"]').change(function() {
            var provinceId = $(this).val(); // Ambil ID provinsi yang dipilih
            var provinceName = $(this).find("option:selected").text(); // Ambil nama provinsi yang dipilih
            $('#nama_prop').val(provinceName); // Set nilai input dengan id 'copyprov' ke nama provinsi
            $('#idprov').val(provinceId); // Set nilai input dengan id 'idcopyprov' ke ID provinsi
        });

        $('select[name="nama_kabkots"]').change(function() {
            var provinceId = $(this).val();
            var provinceName = $(this).find("option:selected").text(); // Ambil nama provinsi yang dipilih
            $('#nama_kabkot').val(provinceName); // Set nilai input dengan id 'tes' ke nama provinsi
            $('#idkabkot').val(provinceId);
        });

        $('select[name="nama_kecs"]').change(function() {
            var provinceId = $(this).val();
            var provinceName = $(this).find("option:selected").text(); // Ambil nama provinsi yang dipilih
            $('#nama_kec').val(provinceName); // Set nilai input dengan id 'tes' ke nama provinsi
            $('#idkec').val(provinceId);
        });

        $('select[name="nama_kels"]').change(function() {
            var provinceId = $(this).val();
            var provinceName = $(this).find("option:selected").text(); // Ambil nama provinsi yang dipilih
            $('#nama_kel').val(provinceName); // Set nilai input dengan id 'tes' ke nama provinsi
            $('#idkel').val(provinceId);
        });

    });
 </script>
 @endpush
