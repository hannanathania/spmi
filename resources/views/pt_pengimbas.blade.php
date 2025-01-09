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
                <h6 class="m-0 font-weight-bold text-primary">Daftar PT Pengimbas SPMI</h6>
            </div>
            
    <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0"> <!-- Added table-bordered for clearer separation of cells -->
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode PT Pengimbas</th>
                    <th>Nama PT Pengimbas</th>
                    <th>Klaster PT Pengimbas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedData as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}. </td>
                    <td>{{ $item['kode_pt_peng'] ?? 'Tidak Ada'  }}</td>
                    <td>{{ $item['nama_pt_peng'] ?? 'Tidak Ada' }}</td>
                    @if($item['klaster_pengimbas']  == 'hijau')
                        <td>
                            <span class="badge badge-success" >{{ ucfirst($item['klaster_pengimbas']) }}</span>
                        </td>
                    @elseif($item['klaster_pengimbas'] == 'merah')
                        <td>
                            <span class="badge badge-danger" >{{ ucfirst($item['klaster_pengimbas']) }}</span>
                        </td>
                    @elseif($item['klaster_pengimbas'] == 'kuning')
                        <td>
                            <span class="badge badge-warning" >{{ ucfirst($item['klaster_pengimbas']) }}</span>
                        </td>
                    @else
                        <td>
                            <span class="badge badge-secondary" disabled>{{ ucfirst($item['klaster_pengimbas']) }}</span>
                        </td>
                    @endif 
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item['kode_pt_peng'] }}">
                            <i class="fas fa-eye"></i>
                        </button>   
                        <div class="modal fade" id="detailModal{{ $item['kode_pt_peng'] }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item['kode_pt_peng'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $item['kode_pt_peng']  }}">Detail PT Asuh : {{ $item['nama_pt_peng'] }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode PT</th>
                                                    <th scope="col">Nama PT</th> 
                                                    <th scope="col">Klaster</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item['pt_asuh'] as $pt_asuh)
                                                    <tr>
                                                        <td>{{ $pt_asuh['kode_pt_asuh'] }}</td>
                                                        <td>{{ $pt_asuh['nama_pt_asuh']}}</td>                                                                    
                                                        @if($pt_asuh['klaster_asuh'] == 'hijau')
                                                            <td>
                                                                <span class="badge badge-success">{{ ucfirst($pt_asuh['klaster_asuh'] ) }}</span>
                                                            </td>
                                                        @elseif($pt_asuh['klaster_asuh'] == 'merah')
                                                            <td>
                                                                <span class="badge badge-danger">{{ ucfirst($pt_asuh['klaster_asuh'] ) }}</span>
                                                            </td>
                                                        @elseif($pt_asuh['klaster_asuh']  == 'kuning')
                                                            <td>
                                                                <span class="badge badge-warning">{{ ucfirst($pt_asuh['klaster_asuh'] ) }}</span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge badge-secondary" disabled>{{ $pt_asuh['klaster_asuh']  }}</span>
                                                            </td>
                                                        @endif
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