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
                    @if(session('admin_username'))
                        <a href="/klinik_spmi/tambah" class="btn btn-primary btn-user">+ Tambah Perguruan Tinggi</a>
                    @endif
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0"> <!-- Added table-bordered for clearer separation of cells -->
                        <thead>
                            <tr>  
                                <th scope="col">Nama PT</th>
                                <th scope="col">Nama Verifikator</th>
                                <th scope="col">Tahap</th>
                                <th scope="col">Tanggal Klinik</th>
                                <th scope="col">Progress PT</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $item['ptspmi'] }}</td>
                                <td>{{ $item['nama_faswil'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>

    @endsection
</body>