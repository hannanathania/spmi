<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPMI - LLDIKTI 4</title>

    <!-- CSS Dependencies -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Custom styles for this page -->
    <!-- <link href="{{asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> -->
</head>

<body id="page-top">
    @extends('layouts.template')
    @section('content')
    
    <div class="container-fluid">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Klasterisasi SPMI</h1>
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#klasterMerahModal">
                        <div class="card border-left-danger shadow h-100 py-2 hover-effect">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Klaster Merah</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data_total['klaster_merah']}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="modal fade" id="klasterMerahModal" tabindex="-1" aria-labelledby="klasterMerahModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="klasterMerahModalLabel">Detail Klaster Merah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi modal yang diinginkan -->

                                    <table class="table table-bordered" id="myTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama PT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                @if($item['klaster'] == 'merah')
                                                    <tr>
                                                        <td>{{ $item['pt'] }}</td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="2">Tidak ada data dengan klaster merah.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#klasterKuningModal">
                        <div class="card border-left-warning shadow h-100 py-2 hover-effect">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Klaster Kuning</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data_total['klaster_kuning']}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="modal fade" id="klasterKuningModal" tabindex="-1" aria-labelledby="klasterKuningModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="klasterKuningModalLabel">Detail Klaster Kuning</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi modal yang diinginkan -->

                                    <table class="table table-bordered" id="myTable3" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama PT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                @if($item['klaster'] == 'kuning')
                                                    <tr>
                                                        <td>{{ $item['pt'] }}</td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="2">Tidak ada data dengan klaster kuning</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#klasterHijauModal">
                    <div class="card border-left-success shadow h-100 py-2 hover-effect">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Klaster Hijau</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data_total['klaster_hijau']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="modal fade" id="klasterHijauModal" tabindex="-1" aria-labelledby="klasterHijauModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="klasterHijauModalLabel">Detail Klaster Hijau</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi modal yang diinginkan -->

                                    <table class="table table-bordered" id="myTable4" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama PT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                @if($item['klaster'] == 'hijau')
                                                    <tr>
                                                        <td>{{ $item['pt'] }}</td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="2">Tidak ada data dengan klaster hijau.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Klasterisasi SPMI</h6>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0"> <!-- Added table-bordered for clearer separation of cells -->
                    <thead>
                        <tr>
                            <th scope="col">Kode PT</th>
                            <th scope="col">Nama PT</th>
                            <th scope="col">Klaster</th>
                            <!-- <th scope="col">Detail</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item['kode_pt'] }}</td>
                            <td>{{ $item['pt'] }}</td>
                            @if($item['klaster'] == 'hijau')
                                <td>
                                    <span class="badge badge-success" disabled>{{ ucfirst($item['klaster']) }}</span>
                                </td>
                            @elseif($item['klaster'] == 'merah')
                                <td>
                                    <span class="badge badge-danger" disabled>{{ ucfirst($item['klaster']) }}</span>
                                </td>
                            @elseif($item['klaster'] == 'kuning')
                                <td>
                                    <span class="badge badge-warning" disabled>{{ ucfirst($item['klaster']) }}</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-secondary" disabled>{{ ucfirst($item['klaster']) }}</span>
                                </td>
                            @endif
                            <!-- <td>
                                <a href="{{ route('detail_spmi', ['pt' => $item['pt']]) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </td> -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No user found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>
    <script>let table2 = new DataTable('#myTable2');</script>
    <script>let table3 = new DataTable('#myTable3');</script>
    <script>let table4 = new DataTable('#myTable4');</script>

    @endsection
</body>
</html>
