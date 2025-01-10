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
        <h1 class="h3 mb-2 text-gray-800">Verifikator SPMI</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sebaran Verifikator</h6>
            </div>
            <div class="chart-bar pt-4">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Verifikator SPMI</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Verifikator</th>
                                <th scope="col">Dokumen yang belum diverifikasi</th> 
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedData as $kode_faswil => $items)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $items['nama_faswil'] }}</td>
                                    <td>
                                        <span class="badge {{ $items['total_verif'] > 0 ? 'badge-danger' : 'badge-success' }}">
                                            {{ $items['total_verif'] }} dokumen
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $kode_faswil }}">
                                            <i class="fas fa-eye"></i> List PT
                                        </button>
                                        <div class="modal fade" id="detailModal{{ $kode_faswil }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $kode_faswil }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailModalLabel{{ $kode_faswil }}">Detail Perguruan Tinggi: {{ $items['nama_faswil'] }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Kode PT</th>
                                                                    <th scope="col">Nama PT</th> 
                                                                    <th scope="col">Klaster</th> 
                                                                    <th scope="col">Dokumen yang perlu diverifikasi</th> 
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($items['pt'] as $pt)
                                                                    <tr>
                                                                        <td>{{ $pt['kode_pt'] }}</td>
                                                                        <td>
                                                                            <a href="{{ route('detail_spmi', ['pt' => $pt['nama_pt']]) }}">
                                                                                {{ $pt['nama_pt']}}
                                                                            </a>
                                                                        </td>                                                                 
                                                                        @if($pt['klaster'] == 'hijau')
                                                                            <td>
                                                                                <span class="badge badge-success">{{ ucfirst($pt['klaster']) }}</span>
                                                                            </td>
                                                                        @elseif($pt['klaster'] == 'merah')
                                                                            <td>
                                                                                <span class="badge badge-danger">{{ ucfirst($pt['klaster']) }}</span>
                                                                            </td>
                                                                        @elseif($pt['klaster'] == 'kuning')
                                                                            <td>
                                                                                <span class="badge badge-warning">{{ ucfirst($pt['klaster']) }}</span>
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                <span class="badge badge-secondary" disabled>{{ $pt['klaster'] }}</span>
                                                                            </td>
                                                                        @endif
                                                                        <td>
                                                                            <span class="badge {{ $pt['perlu_verif'] > 0 ? 'badge-danger' : 'badge-success' }}">
                                                                                {{ $pt['perlu_verif'] }} dokumen
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
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

    <!-- Bootstrap JS for modal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('admin_assets/js/demo/chart-bar-demo.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    @endsection
</body>

</html>