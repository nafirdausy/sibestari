@extends('admin.layouts.index')
@section('main')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2 ml-4 text-gray-800">Periode</h1>
                </div>
                <div>
                    <a href="/tambahperiode" class="text-decoration-none text-white mr-5">
                        <button type="button"
                            class="btn btn-primary btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i>
                            Tambah Periode
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire(
                    'Sukses',
                    '{{ Session::get('success') }}',
                    'success'
                );
            });
        </script>
    @endif
    <div class="col-lg-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Masa Periode</th>
                                <th>Status</th>
                                <th>Kuota</th>
                                <th>Pengumuman</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($periode as $item)
                            <tbody>
                                <td>Periode ke-{{ $item->nama_periode }}</td>
                                <td>
                                    <div><b>Tanggal Pendaftaran Dibuka  :</b> {{ $item->tgl_buka }}</div>
                                    <div><b>Tanggal Pendaftaran Ditutup :</b>  {{ $item->tgl_tutup }}</div>
                                    <div><b>Tanggal Pengumuman          :</b>  {{ $item->tgl_pengumuman }}</div>
                                </td>
                                @if ($item->status_periode === 'buka')
                                    <td><a class="btn-sm btn-secondary text-decoration-none" disable 
                                    style="background-color: #4CAF50;">Dibuka</a></td>
                                @else
                                <td><a class="btn-sm btn-secondary text-decoration-none" disable 
                                    style="background-color: #C51F1A;">Ditutup</a></td>
                                @endif
                                <td>{{ $item->kuota }}</td>
                                <td>{{ $item->pengumuman }}</td>
                                <td><a href="/editperiode/{{ $item->id }}"
                                        class="btn-sm btn-warning text-decoration-none">Edit</a>
                                    <form onsubmit="return confirmDelete(event)" class="d-inline"
                                        action="/hapusperiode/{{ $item->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Menghentikan form dari pengiriman langsung

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                swal('Your imaginary file is safe!');
            }
        });
    }
</script>