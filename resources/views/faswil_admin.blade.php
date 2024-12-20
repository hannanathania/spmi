<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPMI - LLDIKTI 4</title>
    <!-- CSS Dependencies -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS for modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('layouts.template')
    @section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Verifikator SPMI</h6>
            </div>
          
            <div class="card-body">
                <a href="/admin/fasilitator_wilayah/create" class="btn btn-primary btn-user">+ Tambah Penugasan</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Kode PT</th>
                                <th scope="col">Nama PT</th>
                                <th scope="col">Nama Verifikator</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($groupedData as $kode_faswil => $items)
                            <!-- Loop untuk faswil -->
                            @foreach ($items['pt'] as $pt)
                            <tr>
                                <!-- Tampilkan nama_faswil di setiap baris -->
                                <td>{{ $pt['kode_pt'] }}</td>
                                <td>{{ $pt['nama_pt'] }}</td>
                                <td>{{ $items['nama_faswil'] }}</td>
                                <!-- Tampilkan nama PT di setiap baris -->
                                <td>                                    
                                    <!-- Form untuk delete -->
                                    <form action="{{ route('delete_faswil', $pt['kode_pt']) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Anda yakin akan menghapus penugasan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- Bootstrap JS for modal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>
    @endsection
</body>

</html>
