@extends('admin.layouts.index')
@section('main')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="font-weight-bold mb-0 ml-5">Data Koordinator</h4>
                </div>
                <div>
                    <a href="/tambahuc" class="text-decoration-none text-white mr-5">
                        <button type="button"
                            class="btn btn-primary btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i>
                            Tambah Koordinator 
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
                                <th>
                                    Foto
                                </th>
                                <th>
                                    Nama Lengkap
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        @foreach ($uc as $item)
                            <tbody>
                                <td class="py-1">
                                    <img src="{{ asset('picture/accounts') }}/{{ $item->gambar }}" alt="image" height="50" width="50"/>
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                <td>{{ $item->email }}</td>
                                @if ($item->role === 'admin')
                                    <td style="color:rgb(0, 255, 0); font-weight: bold;">
                                        {{ $item->role }}</td>
                                @else
                                    <td>{{ $item->role }}</td>
                                @endif
                                @if ($item->role === 'admin')
                                    <td style="color:rgb(0, 255, 0); font-weight: bold;">Admin User</td>
                                @else
                                    <td>
                                        <a href="/detailuc/{{ $item->id }}"
                                        class="btn-sm btn-secondary text-decoration-none">Detail</a>
                                        <a href="/edituc/{{ $item->id }}"
                                            class="btn-sm btn-warning text-decoration-none">Edit</a>
                                        <form onsubmit="return confirmDelete(event)" class="d-inline"
                                            action="/hapusuc/{{ $item->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-danger btn-sm">Hapus</button>
                                        </form>
                                @endif
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