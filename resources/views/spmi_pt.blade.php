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
    

</head>

<body id="page-top">
    @extends('layouts.template')
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Kelengkapan SPMI PT</h1> -->

    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kelengkapan SPMI</h6>
            </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="myTable2" width="100%" cellspacing="0"> <!-- Added table-bordered for clearer separation of cells -->
                <thead>
                    <tr>
                        <th scope="col">Kode PT</th>
                        <th scope="col">Nama PT</th>
                        <th scope="col">Presentase Unggah</th>
                        <th scope="col">Presentase Verifikasi</th>
                        <th scope="col">Presentase Validasi</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item['kode_pt'] }}</td>
                        <td>{{ $item['pt'] }}</td>
                        <td>{{ $item['presentase_unggah'] }}%</td>
                        <td>{{ $item['presentase_verif'] }}%</td>
                        <td>{{ $item['presentase_valid'] }}%</td>
                        <td>
                            <a href="{{ route('detail', ['pt' => $item['pt']]) }}" class="btn btn-primary mt-0">Lihat Detail</a>
                        </td>
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
 
  
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
        </a>

        <!-- Page level plugins -->
        <script src="{{asset('admin_assets/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.js"></script>
        
        <!-- Page level custom scripts -->
        <script src="{{asset('admin_assets/js/demo/chart-pie-demo.js')}}"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script>let table = new DataTable('#myTable2');</script>
        
    @endsection
              
</body>

</html>