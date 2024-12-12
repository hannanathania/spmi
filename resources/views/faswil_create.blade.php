<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMI - LLDIKTI 4</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Select CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" rel="stylesheet">
</head>

<body>
    @extends('layouts.template')
    @section('content')
    <div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Penugasan Verifikator SPMI</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nama Verifikator Wilayah</label>
                    <select class="selectpicker form-control" id="exampleFormControlSelect1" data-live-search="true">
                        @foreach ($faswil as $item)
                            <option>{{$item['nama_faswil']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="multiSelect">Pilih Perguruan Tinggi</label>
                    <select class="selectpicker form-control" multiple data-selected-text-format="count > 3" data-live-search="true">
                        @foreach ($pt as $item)
                            <option>{{$item['kodept']}} - {{$item['ptspmi']}}</option>
                        @endforeach
                    </select>
                    
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>

    </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Bootstrap Select
            $('.selectpicker').selectpicker();
        });

        $('#multiSelect').on('change', function () {
            let selectedCount = $(this).val().length; // Hitung jumlah yang dipilih
            $('#selectedCount').text(selectedCount); // Update teks jumlah pilihan
        });
    </script>

    @endsection
</body>

</html>
