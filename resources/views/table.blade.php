<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SPMI - LLDIKTI 4</title>

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">

    <body id="page-top">
        @extends('layouts.template')
        @section('content')
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">{{ $item['pt'] }}</h1>
            <h1 class="h4 mb-2 text-gray-600">{{ $item['kode_pt'] }}</h1>

            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Dokumen yang perlu diupload</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['unggah_seharusnya'] - $item['unggah']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Dokumen yang perlu direvisi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['ver'] - $item['valid']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Dokumen yang perlu dicek verifikator</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['unggah'] - $item['ver']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Dokumen sudah valid</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['valid']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Header - Accordion -->
            <div class="card shadow mb-4">
                <a href="#collapseCardKebijakan" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardKebijakan">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Kebijakan
                        @if($item['kebijakan_valid'] >= 6)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                            @else
                            <i class="fas fa-times-circle text-danger ml-2"></i>
                        @endif
                    </h6>
                </a>
                <div class="collapse hide" id="collapseCardKebijakan">
                    <div class="card-body">
                        @if($item['kebijakan_valid'] >= 6)
                                <p>Dokumen kebijakan sudah valid</p>
                        @else
                            @if($item['kebijakan_unggah'] < 6)
                                <p>Dokumen yang perlu diunggah : {{6 - $item['kebijakan_unggah']}} dokumen</p>
                            @endif
                            @if($item['kebijakan_verif'] - $item['kebijakan_valid'] > 0)
                                <p>Dokumen perlu diperbaiki : {{$item['kebijakan_verif'] - $item['kebijakan_valid']}} dokumen</p>
                            @endif
                            @if($item['kebijakan_unggah'] - $item['kebijakan_verif'] > 0)
                                <p>Dokumen perlu diperiksa oleh verifikator : {{$item['kebijakan_unggah'] - $item['kebijakan_verif']}} dokumen</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Header - Accordion -->
            <div class="card shadow mb-4">
                <a href="#collapseCardStandar" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardStandar">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Standar Institusi
                        @if($item['standar_valid'] >= 10)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                            @else
                            <i class="fas fa-times-circle text-danger ml-2"></i>
                        @endif
                    </h6>
                </a>
                <div class="collapse hide" id="collapseCardStandar">
                    <div class="card-body">
                        @if($item['standar_valid'] >= 10)
                                <p>Dokumen standar institusi sudah valid</p>
                        @else
                            @if($item['standar_unggah'] < 10)
                                <p>Dokumen yang perlu diunggah : {{10 - $item['standar_unggah']}} dokumen</p>
                            @endif
                            @if($item['standar_verif'] - $item['standar_valid'] > 0)
                                <p>Dokumen perlu diperbaiki : {{$item['standar_verif'] - $item['standar_valid']}} dokumen</p>
                            @endif
                            @if($item['standar_unggah'] - $item['standar_verif'] >0)
                                <p>Dokumen perlu diperiksa oleh verifikator : {{$item['standar_unggah'] - $item['standar_verif']}} dokumen</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Header - Accordion -->
            <div class="card shadow mb-4">
                <a href="#collapseCardAmi" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardAmi">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Audit Mutu Internal
                        @if($item['ami_valid'] >= 3)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                            @else
                            <i class="fas fa-times-circle text-danger ml-2"></i>
                        @endif
                    </h6>
                </a>
                <div class="collapse hide" id="collapseCardAmi">
                    <div class="card-body">
                    @if($item['ami_valid'] >= 3)
                            <p>Dokumen audit mutu internal sudah valid</p>
                    @else
                        @if($item['ami_unggah'] < 3)
                            <p>Dokumen yang perlu diunggah : {{3 - $item['ami_unggah']}} dokumen</p>
                        @endif
                        @if($item['ami_verif'] - $item['ami_valid'] > 0)
                            <p>Dokumen perlu diperbaiki : {{$item['ami_verif'] - $item['ami_valid']}} dokumen</p>
                        @endif
                        @if($item['ami_unggah'] - $item['ami_verif']>0)
                            <p>Dokumen perlu diperiksa oleh verifikator : {{$item['ami_unggah'] - $item['ami_verif']}} dokumen</p>
                        @endif
                    @endif
                    </div>
                </div>
            </div>

            <!-- Card Header - Accordion -->
            <div class="card shadow mb-4">
                <a href="#collapseCardPengendalian" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardPengendalian">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pengendalian
                        @if($item['pengendalian_valid'] >= 10)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                        @else
                            <i class="fas fa-times-circle text-danger ml-2"></i>
                        @endif
                    </h6>
                </a>

                <div class="collapse hide" id="collapseCardPengendalian">
                    <div class="card-body">
                        @if($item['pengendalian_valid'] >= 10)
                                <p>Dokumen pengendalian sudah valid</p>
                        @else
                            @if($item['pengendalian_unggah'] < 10)
                                <p>Dokumen yang perlu diunggah : {{10 - $item['pengendalian_unggah']}} dokumen</p>
                            @endif
                            @if($item['pengendalian_verif'] - $item['pengendalian_valid'] > 0)
                                <p>Dokumen perlu diperbaiki : {{$item['pengendalian_verif'] - $item['pengendalian_valid']}} dokumen</p>
                            @endif
                            @if($item['pengendalian_unggah'] - $item['pengendalian_verif']>0)
                                <p>Dokumen perlu diperiksa oleh verifikator : {{$item['pengendalian_unggah'] - $item['pengendalian_verif']}} dokumen</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Header - Accordion -->
            <div class="card shadow mb-4">
                <a href="#collapseCardPeningkatan" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardPeningkatan">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Peningkatan
                        @if($item['peningkatan_valid'] >= 6)
                            <i class="fa fa-check-circle text-success ml-2"></i>
                        @else
                            <i class="fas fa-times-circle text-danger ml-2"></i>
                        @endif
                    </h6>
                </a>

                <div class="collapse hide" id="collapseCardPeningkatan">
                    <div class="card-body">
                        @if($item['peningkatan_valid'] >= 6)
                                <p>Dokumen peningkatan sudah valid</p>
                        @else
                            @if($item['peningkatan_unggah'] < 6)
                                <p>Dokumen yang perlu diunggah : {{6 - $item['peningkatan_unggah']}} dokumen</p>
                            @endif
                            @if($item['peningkatan_verif'] - $item['peningkatan_valid'] > 0)
                                <p>Dokumen perlu diperbaiki : {{$item['peningkatan_verif'] - $item['peningkatan_valid']}} dokumen</p>
                            @endif
                            @if($item['peningkatan_unggah'] - $item['peningkatan_verif']>0)
                                <p>Dokumen perlu diperiksa oleh verifikator : {{$item['peningkatan_unggah'] - $item['peningkatan_verif']}} dokumen</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        </div>
        @endsection

        <!-- Scroll to Top Button -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Page level plugins -->
        <script src="{{asset('admin_assets/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    </body>

</html>
