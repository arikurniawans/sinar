@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle1}}</h4>
          </div>
          <div class="d-flex justify-content-between">
            <a href="{{ route('masterwisma.exportexcel', ['id' => $wisma->idwisma]) }}" class="btn btn-success mr-2">Export Excel</a>
            &nbsp;
            <a href="{{ route('masterwisma.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

       </div>
       <div class="card-body">
          <div class="employee-info">
                <!-- Tabel untuk menampilkan informasi -->
                <table class="table" style="width: 100%; border: none; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <!-- Kolom Kiri -->
                            <td style="width: 50%; vertical-align: top;">
                                <table style="width: 100%; border: none;">
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Nama Wisma:</td>
                                        <td>{{ $wisma->nama_wisma }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Alamat:</td>
                                        <td>{{ $wisma->alamat }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Pembina Wisma:</td>
                                        <td>{{ $wisma->pembina_wisma }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Supervisor:</td>
                                        <td>{{ $wisma->supervisor }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Jumlah Tenaga Purna Waktu:</td>
                                        <td>{{ $wisma->jumlah_tng_purna }}</td>
                                    </tr>
                                </table>
                            </td>

                            <!-- Kolom Kanan -->
                            <td style="width: 50%; vertical-align: top;">
                                <table style="width: 100%; border: none;">
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Jumlah Tenaga Part Time:</td>
                                        <td>{{ $wisma->jumlah_tng_part }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Jumlah Kamar:</td>
                                        <td>{{ $wisma->jumlah_kamar }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Jumlah Tempat Tidur:</td>
                                        <td>{{ $wisma->jumlah_tmp_tidur }}</td>
                                    </tr>
                                    <tr style="line-height: 1.5;">
                                        <td style="font-weight: bold; padding: 5px;">Jumlah Anak:</td>
                                        <td>{{ $wisma->jumlah_anak }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>


          </div>
       </div>
    </div>
 </div>


            @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            </div>
            @endif

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

 <div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle2}}</h4>
          </div>
          <div class="">
            <a href="javascript:void(0);" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </i>
                <span>Add Data</span>
            </a>

        </div>
       </div>
       <div class="card-body">
          <div class="employee-info">

            <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                   <thead>
                      <tr>
                         <th>#</th>
                         <th>Nama Tenaga</th>
                         <th>Pendidikan</th>
                         <th>Kedudukan</th>
                         <th>Tempat Tanggal Lahir</th>
                         <th>Keterangan</th>
                         <th>Aksi</th>
                      </tr>
                   </thead>
                   <tbody>
                     @php $no=1; @endphp
                      @foreach($tenaga as $wisma)
                      <tr>
                         <td>{{ $no++ }}</td>
                         <td>No.KK: {{ $wisma->no_kk }}<br/>No. NIK: {{ $wisma->nik }}<br/>Nama Lengkap: {{ $wisma->nama_lengkap }}</td>
                         <td>{{ $wisma->ijazah_tahun }}</td>
                         <td>{{ $wisma->jabatan_tugas }}</td>
                         <td>{{ $wisma->tempat_lahir }}, {{ $wisma->tanggal_lahir }}</td>
                         <td>{{ $wisma->keterangan }}</td>
                         <td>

                             {{-- <a href="{{ route('masterwisma.edit', $wisma->idwisma) }}" class="btn btn-xs btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                 <span class="btn-inner">
                                     <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M13.7476 20.4428H21.0002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.78 3.79479C13.5557 2.86779 14.95 2.73186 15.8962 3.49173C15.9485 3.53296 17.6295 4.83879 17.6295 4.83879C18.669 5.46719 18.992 6.80311 18.3494 7.82259C18.3153 7.87718 8.81195 19.7645 8.81195 19.7645C8.49578 20.1589 8.01583 20.3918 7.50291 20.3973L3.86353 20.443L3.04353 16.9723C2.92866 16.4843 3.04353 15.9718 3.3597 15.5773L12.78 3.79479Z"
                                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path d="M11.021 6.00098L16.4732 10.1881" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                     </svg>
                                 </span>
                             </a> --}}

                             <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Data" onclick="confirmDelete('{{ $wisma->id_masterwisma }}')">
                                 <span class="btn-inner">
                                     <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                         <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                     </svg>
                                 </span>
                             </a>
                         </td>
                      </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>

          </div>
       </div>
    </div>
 </div>


 <div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle3}}</h4>
          </div>
          <div class="">
            <a href="javascript:void(0);" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                <i class="btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </i>
                <span>Add Data</span>
            </a>

        </div>
       </div>
       <div class="card-body">
          <div class="employee-info">

            <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Induk</th>
                            <th>Masuk Tahun</th>
                            <th>Klien</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>Tingkat Per</th>
                            <th>Kode Keuang</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Kasus</th>
                            <th>Kode Kasus</th>
                            <th>Keterangan</th>
                            <th>Aksi</th> <!-- Kolom untuk aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($dataklien as $clients)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $clients->no_induk }}</td>
                                <td>{{ $clients->tahun_masuk }}</td>
                                <td>
                                    No.KK: {{ $clients->no_kk }}<br />
                                    No. NIK: {{ $clients->no_nik }}<br />
                                    Nama Lengkap: {{ $clients->nama_klien }}
                                </td>
                                <td>{{ $clients->tgl_lahir }}</td>
                                <td>{{ $clients->umur }}</td>
                                <td>{{ $clients->sekolah }}</td>
                                <td>{{ $clients->kelas }}</td>
                                <td>{{ $clients->tingkat_per }}</td>
                                <td>{{ $clients->kode_keuangan }}</td>
                                <td>
                                    <i class="icon-calendar-outline"></i> <strong>Tanggal Pemeriksaan 1:</strong> {{ $clients->tanggal_pemeriksaan_1 }}<br/>
                                    <i class="icon-weight-scale-outline"></i> <strong>BB:</strong> {{ $clients->bb_1 }}<br/>
                                    <i class="icon-ruler-outline"></i> <strong>TB:</strong> {{ $clients->tb_1 }}<br/>
                                    <hr style="border: 2px solid #000; margin: 10px 0;"/>
                                    <i class="icon-calendar-outline"></i> <strong>Tanggal Pemeriksaan 2:</strong> {{ $clients->tanggal_pemeriksaan_2 }}<br/>
                                    <i class="icon-weight-scale-outline"></i> <strong>BB:</strong> {{ $clients->bb_2 }}<br/>
                                    <i class="icon-ruler-outline"></i> <strong>TB:</strong> {{ $clients->tb_2 }}<br/>
                                </td>

                                <td>{{ $clients->namakasus }}</td>
                                <td>{{ $clients->kode }}</td>
                                <td>{{ $clients->keterangan }}</td>
                                <td>

                                    <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{ $clients->id_klienwisma }}" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                        <span class="btn-inner">
                                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.7476 20.4428H21.0002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.78 3.79479C13.5557 2.86779 14.95 2.73186 15.8962 3.49173C15.9485 3.53296 17.6295 4.83879 17.6295 4.83879C18.669 5.46719 18.992 6.80311 18.3494 7.82259C18.3153 7.87718 8.81195 19.7645 8.81195 19.7645C8.49578 20.1589 8.01583 20.3918 7.50291 20.3973L3.86353 20.443L3.04353 16.9723C2.92866 16.4843 3.04353 15.9718 3.3597 15.5773L12.78 3.79479Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M11.021 6.00098L16.4732 10.1881" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Data" onclick="confirmDelete3('{{ $clients->id_klienwisma }}')">
                                        <span class="btn-inner">
                                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>

                                    <div class="modal fade" id="staticBackdrop2{{$clients->id_klienwisma}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Penghuni Wisma</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="dataForm" method="POST" action="{{ route('masterwisma.update3', $clients->id_klienwisma) }}">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <!-- Kiri -->
                                                        <div class="row">
                                                            <!-- Kiri -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="noInduk" class="form-label">No Induk <span class="text-danger">*</span></label>
                                                                    <input type="text" id="noInduk" name="no_induk" class="form-control" value="{{$clients->no_induk}}" required>
                                                                    <input type="hidden" class="form-control" id="idwisma2" name="idwisma2" value="{{ $wisma->idwisma }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="masukTahun" class="form-label">Masuk Tahun <span class="text-danger">*</span></label>
                                                                    <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" min="1900" max="2100" value="{{$clients->tahun_masuk}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="noKK" class="form-label">No KK <span class="text-danger">*</span></label>
                                                                    <input type="text" id="no_kk" name="no_kk" class="form-control" value="{{$clients->no_kk}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="noNIK" class="form-label">No NIK <span class="text-danger">*</span></label>
                                                                    <input type="text" id="no_nik" name="no_nik" class="form-control" value="{{$clients->no_nik}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="namaKlien" class="form-label">Nama Klien <span class="text-danger">*</span></label>
                                                                    <input type="text" id="nama_klien" name="nama_klien" class="form-control" value="{{ $clients->nama_klien }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tahunLahir" class="form-label">Tahun Lahir <span class="text-danger">*</span></label>
                                                                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{$clients->tgl_lahir}}" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                                                                    <input type="number" readonly id="umur" name="umur" value="{{$clients->umur}}" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kodeKasus" class="form-label">Kode Kasus <span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" id="kode_kasus" name="kode_kasus" required>
                                                                        <option value="" disabled>Pilih Data Kasus</option>
                                                                        <option value="{{$clients->idkasus}}" selected>{{$clients->namakasus}}</option>
                                                                        @foreach ($kasus as $dtkasus)
                                                                            <option value="{{ $dtkasus->idkasus  }}">{{ $dtkasus->kode }} - {{$dtkasus->namakasus}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                                                    <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{$clients->keterangan}}" required>
                                                                </div>
                                                            </div>

                                                            <!-- Kanan -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="sekolah" class="form-label">Sekolah <span class="text-danger">*</span></label>
                                                                    <input type="text" id="sekolah" name="sekolah" class="form-control" value="{{$clients->sekolah}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="sekolah" class="form-label">Kelas <span class="text-danger">*</span></label>
                                                                    <input type="text" id="kelas" name="kelas" class="form-control" value="{{$clients->kelas}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="sekolah" class="form-label">Tingkat Per <span class="text-danger">*</span></label>
                                                                    <input type="text" id="tingkat_per" name="tingkat_per" class="form-control" value="{{$clients->tingkat_per}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="sekolah" class="form-label">Kode Keuangan <span class="text-danger">*</span></label>
                                                                    <input type="text" id="kode_keuangan" name="kode_keuangan" class="form-control" value="{{$clients->kode_keuangan}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tglPemeriksaan1" class="form-label">Tanggal Pemeriksaan 1 <span class="text-danger">*</span></label>
                                                                    <input type="date" id="tanggal_pemeriksaan_1" name="tanggal_pemeriksaan_1" value="{{$clients->tanggal_pemeriksaan_1}}" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="beratBadan1" class="form-label">Berat Badan (Pemeriksaan 1) <span class="text-danger">*</span></label>
                                                                    <input type="number" id="bb_1" name="bb_1" class="form-control" step="0.01" value="{{$clients->bb_1}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tinggiBadan1" class="form-label">Tinggi Badan (Pemeriksaan 1) <span class="text-danger">*</span></label>
                                                                    <input type="number" id="tb_1" name="tb_1" class="form-control" step="0.01" value="{{$clients->tb_1}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tglPemeriksaan2" class="form-label">Tanggal Pemeriksaan 2 <span class="text-danger">*</span></label>
                                                                    <input type="date" id="tanggal_pemeriksaan_2" name="tanggal_pemeriksaan_2" value="{{$clients->tanggal_pemeriksaan_2}}" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="beratBadan2" class="form-label">Berat Badan (Pemeriksaan 2) <span class="text-danger">*</span></label>
                                                                    <input type="number" id="bb_2" name="bb_2" class="form-control" step="0.01" value="{{$clients->bb_2}}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tinggiBadan2" class="form-label">Tinggi Badan (Pemeriksaan 2) <span class="text-danger">*</span></label>
                                                                    <input type="number" id="tb_2" name="tb_2" class="form-control" step="0.01" value="{{$clients->tb_2}}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan Data</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

             </div>

          </div>
       </div>
    </div>
 </div>

 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Input Pengurus Wisma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dataForm" method="POST" action="{{route('masterwisma.store2')}}">
                @csrf
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <select class="form-control select2" id="nama_lengkap" name="nama_lengkap" required>
                                <option value="" disabled selected>Pilih Nama Pengurus</option>
                                @foreach ($pengurus as $pengurusItem)
                                    <option value="{{ $pengurusItem->id }}">{{ $pengurusItem->nama_lengkap }} - [{{ $pengurusItem->status == 1 ? 'Pegawai Tetap' : 'Pegawai Tidak Tetap' }}]</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_kk" class="form-label">NO KK</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" disabled required>
                            <input type="hidden" class="form-control" id="idwisma" name="idwisma" value="{{ $wisma->idwisma }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_nik" class="form-label">NO NIK</label>
                            <input type="text" class="form-control" id="no_nik" name="no_nik" disabled required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <input type="text" class="form-control" id="ijazah_tahun" name="ijazah_tahun" disabled required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jabatan_tugas" class="form-label">Kedudukan</label>
                            <input type="text" class="form-control" id="jabatan_tugas" name="jabatan_tugas" disabled required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" disabled required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" disabled required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" disabled required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input Penghuni Wisma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dataForm" method="POST" action="{{route('masterwisma.store3')}}">
                    @csrf
                <div class="modal-body">

                    <div class="row">
                        <!-- Kiri -->
                        <div class="row">
                            <!-- Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="noInduk" class="form-label">No Induk <span class="text-danger">*</span></label>
                                    <input type="text" id="noInduk" name="no_induk" class="form-control" required>
                                    <input type="hidden" class="form-control" id="idwisma2" name="idwisma2" value="{{ $wisma->idwisma }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="masukTahun" class="form-label">Masuk Tahun <span class="text-danger">*</span></label>
                                    <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" min="1900" max="2100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noKK" class="form-label">No KK <span class="text-danger">*</span></label>
                                    <input type="text" id="no_kk" name="no_kk" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noNIK" class="form-label">No NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="no_nik" name="no_nik" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="namaKlien" class="form-label">Nama Klien <span class="text-danger">*</span></label>
                                    <input type="text" id="nama_klien" name="nama_klien" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tahunLahir" class="form-label">Tahun Lahir <span class="text-danger">*</span></label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                                    <input type="number" readonly id="umur" name="umur" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kodeKasus" class="form-label">Kode Kasus <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="kode_kasus" name="kode_kasus" required>
                                        <option value="" disabled selected>Pilih Data Kasus</option>
                                        @foreach ($kasus as $dtkasus)
                                            <option value="{{ $dtkasus->idkasus  }}">{{ $dtkasus->kode }} - {{$dtkasus->namakasus}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                    <input type="text" id="keterangan" name="keterangan" class="form-control" required>
                                </div>
                            </div>

                            <!-- Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sekolah" class="form-label">Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" id="sekolah" name="sekolah" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sekolah" class="form-label">Kelas <span class="text-danger">*</span></label>
                                    <input type="text" id="kelas" name="kelas" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sekolah" class="form-label">Tingkat Per <span class="text-danger">*</span></label>
                                    <input type="text" id="tingkat_per" name="tingkat_per" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sekolah" class="form-label">Kode Keuangan <span class="text-danger">*</span></label>
                                    <input type="text" id="kode_keuangan" name="kode_keuangan" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tglPemeriksaan1" class="form-label">Tanggal Pemeriksaan 1 <span class="text-danger">*</span></label>
                                    <input type="date" id="tanggal_pemeriksaan_1" name="tanggal_pemeriksaan_1" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="beratBadan1" class="form-label">Berat Badan (Pemeriksaan 1) <span class="text-danger">*</span></label>
                                    <input type="number" id="bb_1" name="bb_1" class="form-control" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tinggiBadan1" class="form-label">Tinggi Badan (Pemeriksaan 1) <span class="text-danger">*</span></label>
                                    <input type="number" id="tb_1" name="tb_1" class="form-control" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tglPemeriksaan2" class="form-label">Tanggal Pemeriksaan 2 <span class="text-danger">*</span></label>
                                    <input type="date" id="tanggal_pemeriksaan_2" name="tanggal_pemeriksaan_2" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="beratBadan2" class="form-label">Berat Badan (Pemeriksaan 2) <span class="text-danger">*</span></label>
                                    <input type="number" id="bb_2" name="bb_2" class="form-control" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tinggiBadan2" class="form-label">Tinggi Badan (Pemeriksaan 2) <span class="text-danger">*</span></label>
                                    <input type="number" id="tb_2" name="tb_2" class="form-control" step="0.01" required>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
            </div>
        </div>
        </div>

 @endsection

 @push('scripts')
 <script>
    $(document).ready(function () {
    $('#staticBackdrop').on('shown.bs.modal', function () {
        if (!$('#nama_lengkap').hasClass('select2-hidden-accessible')) {
            $('#nama_lengkap').select2({
                placeholder: "Pilih Nama Pengurus",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#staticBackdrop') // Tetapkan dropdown di dalam modal
            });
        }
    });

    $('#staticBackdrop2').on('shown.bs.modal', function () {
        if (!$('#kode_kasus').hasClass('select2-hidden-accessible')) {
            $('#kode_kasus').select2({
                placeholder: "Pilih Data Kasus",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#staticBackdrop2') // Tetapkan dropdown di dalam modal
            });
        }
    });

    // Event when an option is selected
    $('#nama_lengkap').on('change', async function () {
    const selectedId = $(this).val(); // Ambil ID yang dipilih

    if (selectedId) {
        try {
            // Lakukan request menggunakan Axios
            const response = await axios.get("{{ route('masterwisma.pengurus', ['id' => '__ID__']) }}".replace('__ID__', selectedId));

            if (response.data.status === 'success') {
                const data = response.data.data;

                // Isi input field dengan data yang diterima
                $('#no_kk').val(data.no_kk !== null ? data.no_kk : '-');
                $('#no_nik').val(data.nik !== null ? data.nik : '-');
                $('#ijazah_tahun').val(data.ijazah_tahun || '');
                $('#jabatan_tugas').val(data.jabatan_tugas || '');
                $('#tempat_lahir').val(data.tempat_lahir || '');
                $('#tanggal_lahir').val(data.tanggal_lahir || '');
                $('#keterangan').val(data.keterangan !== null ? data.keterangan : '-');
            } else {
                alert(response.data.message);
                console.log('Pesan error:', response.data.message);
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
            alert('Terjadi kesalahan saat mengambil data.');
        }
    } else {
        // Kosongkan input field jika tidak ada ID yang dipilih
        $('#no_kk').val('');
        $('#no_nik').val('');
        $('#ijazah_tahun').val('');
        $('#jabatan_tugas').val('');
        $('#tempat_lahir').val('');
        $('#tanggal_lahir').val('');
        $('#keterangan').val('');
    }
});
});

function confirmDelete(userId) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.value) {
            axios.delete("{{ route('masterwisma.destroy2', '') }}/" + userId)
                .then(response => {
                    Swal.fire(
                        'Berhasil!',
                        'Data pengurus wisma telah dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                });
        }
    });
}

function confirmDelete3(userId) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.value) {
            axios.delete("{{ route('masterwisma.destroy3', '') }}/" + userId)
                .then(response => {
                    Swal.fire(
                        'Berhasil!',
                        'Data penghuni wisma telah dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                });
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {
        const tglLahirInput = document.getElementById("tgl_lahir");
        const umurInput = document.getElementById("umur");

        tglLahirInput.addEventListener("change", function () {
            const tglLahir = new Date(this.value);
            const today = new Date();

            if (!isNaN(tglLahir)) {
                let umur = today.getFullYear() - tglLahir.getFullYear();
                const monthDiff = today.getMonth() - tglLahir.getMonth();

                // Jika bulan sekarang kurang dari bulan lahir atau
                // bulan sama tetapi tanggal sekarang kurang dari tanggal lahir, kurangi umur
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < tglLahir.getDate())) {
                    umur--;
                }

                umurInput.value = umur; // Masukkan umur ke input "Umur"
            } else {
                umurInput.value = ""; // Kosongkan input "Umur" jika tanggal lahir tidak valid
            }
        });
    });

</script>

 @endpush

