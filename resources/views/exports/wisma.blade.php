@php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data-penghuni-wisma.xls");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Agar border antar sel tabel tidak ganda */
        }

        th, td {
            border: 8px solid black; /* Menambahkan border pada setiap sel */
            padding: 5px;
            text-align: left; /* Menyelaraskan teks ke kiri */
        }

        th {
            background-color: #f2f2f2; /* Menambahkan warna latar belakang pada header */
            font-weight: bold;
            text-align: center; /* Ensure headers are centered */
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>WISMA:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->nama_wisma)
                    {{$tenaga->first()->nama_wisma}}
                @else
                    -
                @endif
            </td>
            <td>ALAMAT:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->alamat)
                    {{$tenaga->first()->alamat}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>PEMB. WISMA:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->pembina_wisma)
                    {{$tenaga->first()->pembina_wisma}}
                @else
                    -
                @endif
            </td>
            <td>SUPERVISOR:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->supervisor)
                    {{$tenaga->first()->supervisor}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>JML. KAMAR:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->jumlah_kamar)
                    {{$tenaga->first()->jumlah_kamar}}
                @else
                    -
                @endif
            </td>
            <td>JM.T.TIDUR:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->jumlah_tmp_tidur)
                    {{$tenaga->first()->jumlah_tmp_tidur}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>JUM. TENAGA</td>
            <td colspan="3" class="no-border"></td>
            <td>PURNA WAKTU:</td>
            <td class="no-border">
                @if($tenaga->first() && $tenaga->first()->jumlah_tng_purna)
                    {{$tenaga->first()->jumlah_tng_purna}}
                @else
                    -
                @endif
            </td>
            <td>PART TIME:</td>
            <td class="no-border">
                @if($tenaga->first() && $tenaga->first()->jumlah_tng_part)
                    {{$tenaga->first()->jumlah_tng_part}}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>JUM. ANAK:</td>
            <td colspan="3" class="no-border">
                @if($tenaga->first() && $tenaga->first()->jumlah_anak)
                    {{$tenaga->first()->jumlah_anak}}
                @else
                    -
                @endif
            </td>
            <td>TGL. UPDATE:</td>
            <td colspan="3" class="no-border">{{ date('Y-m-d') }}</td>
        </tr>
    </table>


    <br>

    <table>
        <tr>
            <th colspan="6">JUM TENAGA TERDAFTAR: {{ $tenaga->count() }}</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Tenaga</th>
            <th>Pendidikan</th>
            <th>Kedudukan</th>
            <th>Tempat tanggal Lahir</th>
            <th>Keterangan</th>
        </tr>
        @php $no=1; @endphp
        @foreach ($tenaga as $dtenaga)
            <tr>
                <td>{{$no++}}</td>
                <td>No.KK: {{ $dtenaga->no_kk }}<br/>No. NIK: {{ $dtenaga->nik }}<br/>Nama Lengkap: {{ $dtenaga->nama_lengkap }}</td>
                <td>{{$dtenaga->ijazah_tahun}}</td>
                <td>{{$dtenaga->jabatan_tugas}}</td>
                <td>{{ $dtenaga->tempat_lahir }}, {{ $dtenaga->tanggal_lahir }}</td>
                <td>{{$dtenaga->keterangan}}</td>
            </tr>
        @endforeach

    </table>

    <br>

    <table>
        <tr>
            <th colspan="11">JM. ANAK TERDAFTAR: {{ $clients->count() }}</th>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">No Induk</th>
            <th rowspan="2">Masuk Tahun</th>
            <th rowspan="2">Penghuni Wisma</th>
            <th colspan="4">Lahir</th>
            <th rowspan="2">Sekolah</th>
            <th rowspan="2">Kelas</th>
            <th rowspan="2">Tingkat Per</th>
            <th rowspan="2">Kode Keuang</th>
            <th colspan="2">Tanggal Pemeriksaan</th>
            <th rowspan="2">Kasus</th>
            <th rowspan="2">Kode Kasus</th>
            <th rowspan="2">KETERANGAN</th>
        </tr>
        <tr>
            <th>TGL</th>
            <th>BLN</th>
            <th>THN</th>
            <th>Umur</th>
            <th>Tanggal Pemeriksaan 1</th>
            <th>Tanggal Pemeriksaan 2</th>
        </tr>
        @php $no=1; @endphp
        @foreach ($clients as $dclients)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$dclients->no_induk}}</td>
                <td>{{$dclients->tahun_masuk}}</td>
                <td>No.KK: {{ $dclients->no_kk }}<br/>No. NIK: {{ $dclients->no_nik }}<br/>Nama Lengkap: {{ $dclients->nama_klien }}</td>
                <td>{{ \Carbon\Carbon::parse($dclients->tgl_lahir)->day }}</td>
                <td>{{ \Carbon\Carbon::parse($dclients->tgl_lahir)->month }}</td>
                <td>{{ \Carbon\Carbon::parse($dclients->tgl_lahir)->year }}</td>
                <td>{{$dclients->umur}}</td>
                <td>{{$dclients->sekolah}}</td>
                <td>{{$dclients->kelas}}</td>
                <td>{{$dclients->tingkat_per}}</td>
                <td>{{$dclients->kode_keuangan}}</td>
                <td>BB 1: {{$dclients->bb_1}}<br/>TB 1: {{$dclients->tb_1}}</td>
                <td>BB 2: {{$dclients->bb_2}}<br/>TB 2: {{$dclients->tb_2}}</td>
                <td>{{$dclients->namakasus}}</td>
                <td>{{$dclients->kode}}</td>
                <td>{{$dclients->keterangan}}</td>
            </tr>
        @endforeach

    </table>
</body>
</html>
