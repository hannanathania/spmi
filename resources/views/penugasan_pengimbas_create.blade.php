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
                <form action="{{ route('penugasan_pengimbas.store') }}" method="POST">
                    <!-- Include CSRF Token -->
                    @csrf

                    <!-- Single Select with Live Search -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama PT Pengimbas</label>
                        <select class="selectpicker form-control" id="exampleFormControlSelect1" name="kode_pt_pengimbas" data-live-search="true">
                            <option value="" disabled selected>Pilih Nama Perguruan Tinggi</option> 
                            @foreach ($pt_pengimbas as $item)
                                <option value="{{ $item['kodept'] }}">
                                    {{ $item['kodept'] }} - {{ $item['ptspmi'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <a type="button" class="link" name="add" id="add" style="margin-bottom: 10px; display: block; text-align: right;">
                        + Tambah Perguruan Tinggi
                    </a>


                    <table class="table table-bordered" id="table">
                        <tr>
                            <th>Nama PT Asuh</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                    <div class="form-group">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    @if (session('success'))
                    <script type="text/javascript">
                            alert("{{ session('success') }}");
                        </script>
                    @endif

                    @if (session('error'))
                        <script type="text/javascript">
                            alert("{{ session('error') }}");
                        </script>
                    @endif
                    
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
        let ptData; // Declare ptData in a higher scope so it's accessible everywhere
        // Fetch data from the server
        fetch('/data/pt_pengimbas')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                ptData = data.pt_asuh; // Store the fetched data into ptData
                console.log(ptData);  // Log ptData to check if it's correctly populated
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });


        var i = 0;
        $('#add').click(function() {
        ++i;
        let options = '<option value="" disabled selected>Pilih Nama Perguruan Tinggi</option>';
        
        // Loop through ptData to create the <option> elements dynamically
        ptData.forEach(function(item) {
            
            options += ` 
            <option value="${item.kodept}">${item.kodept} - ${item.ptspmi}</option>
            `;
        });

        $('#table').append(
            `<tr>
                <td>
                    <select id="multiSelect${i}" name="kode_pt_asuh[]" class="selectpicker form-control" data-live-search="true">
                        ${options}
                    </select>
                </td>
                <td>
                    <a href="#" type="button" class="btn btn-danger remove-table-row">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>`

        );

        $('select[name^="kode_pt_asuh"]').each(function () {
                console.log($(this).val()); // Ambil dan cetak nilai
            });

        // Jika ingin trigger saat nilai berubah
        $('select[name^="kode_pt_asuh"]').on('change', function () {
            console.log($(this).val());
        });

        $(document).on('click', '.remove-table-row', function(){
            $(this).parents('tr').remove();
        });
        
        // Reinitialize the selectpicker for the new select element
        $('.selectpicker').selectpicker();

    });


    </script>


    @endsection
</body>

</html>
