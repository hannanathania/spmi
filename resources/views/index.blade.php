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

    <!-- Content Row -->

    <div class="container-fluid">
    <!-- Page Heading -->
    <center>
        <h1 class="h3 mb-2 text-gray-800">Sistem Penjaminan Mutu Internal - LLDIKTI IV</h1>
        <p class="mb-4">Selamat Datang di website SPMI untuk perguruan tinggi di wilayah LLDIKTI IV. 
            Website ini berisi tentang Pelaporan SPMI Perguruan Tinggi, Ploting PT kepada Verifikator SPMI, Klasterisasi SPMI, Klinik SPMI bagi perguruan tinggi, dan juga Direktori Perguruan Tinggi. 
        </p>
        <p>Buku SPMI dan Pedoman PT Pengimbas SPMI LLDIKTI IV dapat diakses dan diunduh di sini <a href="https://drive.google.com/drive/folders/15IhWUK_Us-g2Q7OHPw5dL9qS44seI84e">Buku Pedoman SPMI</a></p>
    </center>

    <!-- Charts Section -->
    <div class="row">
        <!-- Chart 1 -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Klasterisasi SPMI di LLDIKTI IV</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-3">
                        <canvas id="myPieChart4"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Klaster Hijau: {{$total_semua['klaster_hijau']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Klaster Kuning: {{$total_semua['klaster_kuning']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Klaster Merah: {{$total_semua['klaster_merah']}} PT
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2 -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akreditasi PT di LLDIKTI IV</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-3">
                        <canvas id="myPieChart5"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #4e73df;"></i> Unggul: {{ $countAkreditasi['Unggul'] ?? 0 }} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #1cc88a;"></i> A: {{ $countAkreditasi['A'] ?? 0 }} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #36b9cc;"></i> Baik Sekali: {{ $countAkreditasi['Baik Sekali'] ?? 0 }} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #6a89cc;"></i> Baik: {{ $countAkreditasi['Baik'] ?? 0 }} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #17a673;"></i> B: {{ $countAkreditasi['B'] ?? 0 }} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #2c9faf;"></i> Tidak Tersedia: {{ $countAkreditasi['Tidak tersedia'] ?? 0 }} PT
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 3 -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Unggah Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-3">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Belum Unggah: {{$total_semua['belum_unggah']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sebagian Unggah: {{$total_semua['sebagian_unggah']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Semua Unggah: {{$total_semua['semua_unggah']}} PT
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 4 -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Dokumen Terverifikasi</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart2"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Belum Terverifikasi: {{$total_semua['belum_ver']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sebagian Terverifikasi: {{$total_semua['sebagian_ver']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Semua Terverifikasi: {{$total_semua['semua_ver']}} PT
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 5 -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Dokumen Valid</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart3"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Belum Valid: {{$total_semua['belum_valid']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sebagian Valid: {{$total_semua['sebagian_valid']}} PT
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Semua Valid: {{$total_semua['semua_valid']}} PT
                        </span>
                    </div>
                </div>
            </div>
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