<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPMI - LLDIKTI 4</title>
    <!-- Add in the <head> section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
        <form>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama Verifikator Wilayah</label>
                <select class="selectpicker form-control" data-live-search="true">
                    @foreach ($faswil as $item)
                        <option>{{$item['nama_faswil']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect2">Nama Perguruan Tinggi</label>
                <select class="selectpicker form-control" data-live-search="true">
                    @foreach ($pt as $item)
                        <option>{{$item['kodept']}} - {{$item['ptspmi']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="multiSelect">Tahap</label>
                    <select class="selectpicker form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="date">Tanggal Klinik</label>
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group Scol-md-6">
                    <label for="multiSelect">Progress PT</label>
                    <select class="selectpicker form-control">
                        <option>Ada</option>
                        <option>Tidak Ada</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="date">Tanggal Pelaporan Dokumen</label>
                    <div class="input-group date" id="datepicker2">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>  

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi Progress</label>
                <textarea class=" form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Hasil Evaluasi Faswil</label>
                <textarea class=" form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi Evaluasi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <br>
            
        </form>
    </div>
    
    <script type="text/javascript">
        $(function() {
            $('.selectpicker').selectpicker();
        });
        $(function() {
            $('#datepicker').datepicker();
        });
        $(function() {
            $('#datepicker2').datepicker();
        });
    </script>


    @endsection
</body>