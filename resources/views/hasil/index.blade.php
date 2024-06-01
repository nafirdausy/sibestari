@extends('admin.layouts.index') 
@section('main')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hasil Rekomendasi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
                <form action="{{ route('hasil.showRiwayat') }}" method="POST">
                        @csrf
                    <div class="row mb-3">
                        <div class="col-2"> 
                            <h4>Pilih Periode :</h4>
                        </div>
                        <div class="col-4">
                        <select name="id_periode" id="periode" class="form-control">
                            @foreach($dataPeriode as $prd)
                                <option value="{{ $prd->id }}" {{ isset($periodeId) && $periodeId == $prd->id ? 'selected' : '' }}>
                                    {{ $prd->nama_periode }} : {{ $prd->tgl_buka }} sampai {{ $prd->tgl_tutup}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary" >Pilih</button>
                        </div>
                    </div>
                </form>
    </div>
    <div class="card-body">
        <!-- Informasi kuota periode -->
        @if ($periodeId)
            <h4>Daftar Siswa Rekomendasi dengan Kuota: {{ $kuota }}</h4>
        @endif
        <div class="table-responsive">
         <!-- Tabel hasil evaluasi yang masuk dalam kuota -->
        @if ($kuota > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lembaga</th>
                            <th>Nama Siswa</th>
                            <th>Nilai</th>
                            <th>Penerimaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataEvaluasi->take($kuota) as $item)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->nama_lembaga }}</td>
                                <td>{{ $item->alternative->nama }}</td>
                                <td>{{ $item->hasil}}</td>
                                <td>
                                    <form onsubmit="return confirmTerima(event)" action="{{ route('hasil.terima', ['id' => $item['id']]) }}" method="post" class="d-inline">
                                        @csrf
                                        @php
                                            $penerima = \App\Models\Penerimaan::where('id_evaluasi', $item['id'])->first();
                                        @endphp
                                        @if ($penerima && $penerima['diterima'])
                                            <button type="button" style="background-color: green; color: white;" disabled>Sudah Diterima</button>
                                        @else
                                            <button type="submit">Terima</button>
                                        @endif
                                    </form>
                                    @if ($penerima && $penerima['diterima'])
                                        <form onsubmit="return confirmHapus(event)" action="{{ route('hasil.hapus', ['id' => $item['id']]) }}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Tabel hasil evaluasi yang tidak masuk dalam kuota -->
            <div class="table-responsive mt-4">
                <h4>Daftar Siswa Tidak Masuk Rekomendasi</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lembaga</th>
                            <th>Nama Siswa</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataEvaluasi->slice($kuota) as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama_lembaga }}</td>
                                <td>{{ $item->alternative->nama }}</td>
                                <td>{{ $item->hasil}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <!-- Informasi jika kuota tidak tersedia -->
        @if ($kuota <= 0)
            <p>Tidak ada kuota tersedia untuk periode ini.</p>
        @endif
    </div>
</div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmTerima(event) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Konfirmasi Penerimaan',
            text: "Anda yakin siswa tersebut akan mendapat beasiswa? Tindakan tidak dapat diurungkan",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); 
            } else {
                Swal.fire('Penerimaan data dibatalkan', '', 'info');
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmHapus(event) {
        event.preventDefault(); 

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