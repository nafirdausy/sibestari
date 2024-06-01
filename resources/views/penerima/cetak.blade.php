<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Penerima Beasiswa</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lembaga</th>
                        <th>Nama Siswa</th>
                        <th>Jenjang</th>
                        <th>Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cetakperiode as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->nama_lembaga }}</td>
                            <td>{{ $item->alternatives->nama }}</td>
                            <td>{{ $item->alternatives->jenjang }}</td>
                            <td>{{ $item->alternatives->sekolah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
