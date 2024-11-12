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
            <p class="mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate architecto porro explicabo sapiente deserunt aspernatur excepturi consequuntur vero! Amet cupiditate nisi sit ullam, voluptatum incidunt veniam eligendi placeat commodi sunt!</p>
            <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
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
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
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
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
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
                            <td>{{ ucfirst($item['klaster']) }}</td>
                            <!-- <td>
                                <a href="{{ route('detail', ['pt' => $item['pt']]) }}" class="btn btn-primary mt-0">Lihat Detail</a>
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

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>

    @endsection
</body>
</html>
