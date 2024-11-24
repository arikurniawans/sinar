@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">Detail Data Binaan Yayasan</h4>
          </div>
          <a href="{{route('databinaan.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
       </div>
       <div class="card-body d-flex">
          <div class="employee-info">

                <div class="row">
                   <!-- Foto Profil -->
                    <div class="col-md-3 profile-card">
                        <div class="text-center">
                            <img src="{{ asset($data_binaan->foto) }}" alt="Foto Pegawai" class="img-thumbnail" style="width: 4cm; height: 5cm; object-fit: cover;">
                        </div>
                        <div class="badge-name">{{ $data_binaan->nama }}</div>
                    </div>
                    <!-- Informasi Biodata -->
                    <div class="col-md-9">
                        <h4 class="text-primary"># Biodata Pegawai</h4>
                        <table class="table table-borderless info-table">
                            <tr>
                                <td><strong>No KK</strong></td>
                                <td>:</td>
                                <td>
                                    <span id="no-kk-hidden">**** **** ****</span>
                                    <span id="no-kk-full" style="display: none;">{{ $data_binaan->no_kk }}</span>
                                    <button type="button" onclick="toggleVisibility('no-kk')" class="btn btn-primary btn-sm">Show/Hide</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>:</td>
                                <td>
                                    <span id="nik-hidden">**** **** ****</span>
                                    <span id="nik-full" style="display: none;">{{ $data_binaan->nik }}</span>
                                    <button type="button" onclick="toggleVisibility('nik')" class="btn btn-primary btn-sm">Show/Hide</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat / Tanggal Lahir</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->tempat_lahir }}, {{ $data_binaan->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat KTP</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->alamat_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>RT / RW</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->rt }} / {{ $data_binaan->rw }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dusun</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->dusun }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Kelurahan</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama_kel }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Kecamatan</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama_kec }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Kabupaten/Kota</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama_kabkot }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Provinsi</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama_prop }}</td>
                            </tr>
                            <tr>
                                <td><strong>Ragam Disabilitas</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->namakasus }}</td>
                            </tr>
                            <tr>
                                <td><strong>Wisma</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->nama_wisma }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>:</td>
                                <td>{{ $data_binaan->keterangan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
          </div>
       </div>
    </div>
 </div>

 @endsection

 @push('scripts')
 <script>
    function toggleVisibility(id) {
        const hiddenElement = document.getElementById(id + '-hidden');
        const fullElement = document.getElementById(id + '-full');

        if (hiddenElement.style.display === 'none') {
            hiddenElement.style.display = 'inline';
            fullElement.style.display = 'none';
        } else {
            hiddenElement.style.display = 'none';
            fullElement.style.display = 'inline';
        }
    }
</script>
 @endpush
