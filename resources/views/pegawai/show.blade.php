@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle}}</h4>
          </div>
          <a href="{{route('pegawai.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
       </div>
       <div class="card-body d-flex">
          <div class="employee-info">

                <div class="row">
                   <!-- Foto Profil -->
                    <div class="col-md-3 profile-card">
                        <div class="text-center">
                            <img src="{{ asset($pegawai->foto) }}" alt="Foto Pegawai" class="img-thumbnail" style="width: 4cm; height: 5cm; object-fit: cover;">
                        </div>
                        {{-- <div class="badge-name">Pasfoto</div> --}}
                    </div>
                    <!-- Informasi Biodata -->
                    <div class="col-md-9">
                        <h4 class="text-primary"># Biodata Pegawai</h4>
                        <table class="table table-borderless info-table">
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nomor Induk Yayasan</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->nomor_yayasan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat / Tanggal Lahir</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td><strong>Agama</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->agama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Ijazah/Tahun</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->ijazah_tahun }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tahun Mulai Bekerja</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->tahun_mulai_bekerja }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan - Tempat Tugas</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->jabatan_tugas }}</td>
                            </tr>
                            <tr>
                                <td><strong>No KK</strong></td>
                                <td>:</td>
                                <td>
                                    <span id="no-kk-hidden">**** **** ****</span>
                                    <span id="no-kk-full" style="display: none;">{{ $pegawai->no_kk }}</span>
                                    <button type="button" onclick="toggleVisibility('no-kk')" class="btn btn-primary btn-sm">Show/Hide</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>:</td>
                                <td>
                                    <span id="nik-hidden">**** **** ****</span>
                                    <span id="nik-full" style="display: none;">{{ $pegawai->nik }}</span>
                                    <button type="button" onclick="toggleVisibility('nik')" class="btn btn-primary btn-sm">Show/Hide</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Unit</strong></td>
                                <td>:</td>
                                <td>{{ $pegawai->unit }}</td>
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
