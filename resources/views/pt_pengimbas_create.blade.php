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
                <h6 class="m-0 font-weight-bold text-primary">Daftar PT Pengimbas SPMI</h6>
            </div>
            
            <div class="card-body">
        <form action="#">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama PT Pengimbas</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Institut Teknologi Nasional Bandung</option>
                    <option>Universitas Katolik Parahyangan</option>
                    <option>Universitas Kristen Maranatha</option>
                    <option>Universitas Islam Bandung</option>
                    <option>5</option>
                </select>
            </div>
            
            <div class="form-group">
                <select class="selectpicker form-control" multiple data-live-search="true">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>
            </div>

            <a href="#" class="btn btn-primary btn-user">Submit</a>
            
        </form>
    </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>let table = new DataTable('#myTable');</script>
    <script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>

       


    @endsection
</body>
