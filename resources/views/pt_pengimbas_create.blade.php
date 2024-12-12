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
                <h6 class="m-0 font-weight-bold text-primary">Tambah Penugasan PT Pengimbas</h6>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <!-- Include CSRF Token -->
                    @csrf

                    <!-- Single Select with Live Search -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama PT Pengimbas</label>
                        <select class="selectpicker form-control" id="exampleFormControlSelect1" data-live-search="true">
                            @foreach ($data as $item)
                                <option value="{{ $item['kode_pt'] }}">
                                    {{ $item['kode_pt'] }} - {{ $item['pt'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Multi-Select with Live Search -->
                    <div class="form-group">
                        <label for="multiSelect">Nama PT Asuh</label>
                        <select id="multiSelect" class="selectpicker form-control" multiple data-live-search="true">
                            @foreach ($data as $item)
                                <option value="{{ $item['kode_pt'] }}">
                                    {{ $item['kode_pt'] }} - {{ $item['pt'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                    <p>Jumlah PT yang dipilih: <span id="selectedCount">0</span></p>
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

            // Update Selected Count for Multi-Select
            $('#multiSelect').on('change', function () {
                let selectedCount = $(this).val().length; // Count selected items
                $('#selectedCount').text(selectedCount); // Update count display
            });
        });
    </script>

    @endsection
</body>

</html>
