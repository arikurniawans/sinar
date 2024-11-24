@extends('layouts.apps')

@section('container-fluid')

    <div class="row">
       <div class="col-12">
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

          <div class="card">
             <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title">
                    <h4 class="card-title mb-0">{{$subtitle}}</h4>
                </div>
                <div class="">
                    <a href="{{route('pegawai2.add')}}" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3">
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
                <div class="table-responsive">
                   <table id="datatable" class="table table-striped" data-toggle="data-table">
                      <thead>
                         <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            {{-- <th>Nomor Induk Yayasan</th> --}}
                            {{-- <th>Ijazah / Tahun</th> --}}
                            <th>Tahun Mulai Bekerja</th>
                            <th>Jabatan - Tempat Tugas</th>
                            {{-- <th>Unit</th> --}}
                            <th>Aksi</th>
                         </tr>
                      </thead>
                      <tbody>
                        @php $no=1; @endphp
                         @foreach($data as $pegawai)
                         <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pegawai->nama_lengkap }}</td>
                            {{-- <td>{{ $pegawai->nomor_induk }}</td> --}}
                            {{-- <td>{{ $pegawai->ijazah_tahun }}</td> --}}
                            <td>{{ $pegawai->tahun_mulai_bekerja }}</td>
                            <td>{{ $pegawai->jabatan_tugas }}</td>
                            {{-- <td>{{ $pegawai->unit }}</td> --}}
                            <td>
                               {{-- <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-info btn-sm">Detail</a>
                               <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                               <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                               </form> --}}
                               <a href="{{ route('pegawai2.show', $pegawai->id) }}" class="btn btn-xs btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="Detail Data">
                                    <span class="btn-inner">
                                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z"
                                            stroke="currentColor"></path>
                                            <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>
                                            <circle cx="12" cy="12" r="3" fill="currentColor"></circle>
                                            <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">
                                                <circle cx="12" cy="12" r="3" fill="currentColor"></circle>
                                            </mask>
                                            <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>
                                        </svg>
                                    </span>
                                </a>

                                <a href="{{ route('pegawai2.edit', $pegawai->id) }}" class="btn btn-xs btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                    <span class="btn-inner">
                                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.7476 20.4428H21.0002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.78 3.79479C13.5557 2.86779 14.95 2.73186 15.8962 3.49173C15.9485 3.53296 17.6295 4.83879 17.6295 4.83879C18.669 5.46719 18.992 6.80311 18.3494 7.82259C18.3153 7.87718 8.81195 19.7645 8.81195 19.7645C8.49578 20.1589 8.01583 20.3918 7.50291 20.3973L3.86353 20.443L3.04353 16.9723C2.92866 16.4843 3.04353 15.9718 3.3597 15.5773L12.78 3.79479Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.021 6.00098L16.4732 10.1881" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>

                                <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Data" onclick="confirmDelete('{{ $pegawai->id }}')">
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
@endsection

@push('scripts')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  // Menambahkan Notiflix untuk menampilkan notifikasi sukses
  @if(session('success'))
    Notiflix.Notify.success('{{ session('success') }}');
  @endif

})

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
            axios.delete("{{ route('pegawai2.destroy', '') }}/" + userId)
                .then(response => {
                    Swal.fire(
                        'Berhasil!',
                        'Data pegawai telah dihapus.',
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
</script>
@endpush
