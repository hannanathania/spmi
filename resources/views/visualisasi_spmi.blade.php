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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>

<body>
    @extends('layouts.template')
    @section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Klinik SPMI</h6>
            </div>
                    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0"> <!-- Added table-bordered for clearer separation of cells -->
                        <thead>
                            <tr>  
                                <th scope="col">Nama PT</th>
                                <th scope="col">Nama Verifikator</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Tanggal Klinik</th>
                                <th scope="col">Progress PT</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['kode_faswil'] }}</td>
                                <td>{{ $item['nama_faswil'] }}</td>
                                <td>{{ $item['tahap'] }}</td>
                                <td>{{ $item['tanggal_klinik'] }}</td>
                                <td>{{ $item['progress'] }}</td>
                                <td>
                                    <!-- Modal Trigger -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item['kode'] }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="viewModal{{ $item['kode'] }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $item['kode'] }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $item['kode'] }}">Detail Klinik</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li><strong>Nama PT:</strong> {{ $item['nama_pt'] }}</li>
                                                <li><strong>Nama Verifikator:</strong> {{ $item['nama_faswil'] }}</li>
                                                <li><strong>Tahap:</strong> {{ $item['tahap'] }}</li>
                                                <li><strong>Tanggal Klinik:</strong> {{ $item['tanggal_klinik'] }}</li>
                                                <li><strong>Progress PT:</strong> {{ $item['progress'] }}</li>
                                                <li><strong>Deskripsi Progress:</strong> {{ $item['deskripsi_progress'] }}</li>
                                                <li><strong>Tanggal Unggah Dokumen:</strong> {{ $item['tanggal_unggah_doc'] }}</li>
                                                <li><strong>Hasil Evaluasi:</strong> {{ $item['hasil_evaluasi'] }}</li>
                                                <li><strong>Deskripsi Evaluasi:</strong> {{ $item['deskripsi_evaluasi'] }}</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>

    @endsection
</body>