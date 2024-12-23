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
                <h6 class="m-0 font-weight-bold text-primary">Tambah Verifikator</h6>
            </div>
            <div class="card-body"> 
                <form id="myForm" action="{{ route('faswil.update', $data['kode_faswil'])}}" method="POST">
                    <!-- Include CSRF Token -->
                    @csrf
                    @method('PUT')
                    <!-- Single Select with Live Search -->
                    <div class="form-group">    
                        <label for="exampleFormControlSelect1">Kode Verifikator</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="exampleFormControlSelect1" 
                            name="kode_faswil" 
                            placeholder="Masukkan kode verifikator"
                            value="{{$data['kode_faswil']}}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Verifikator</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="exampleFormControlSelect1" 
                            name="nama_faswil" 
                            placeholder="Masukkan nama verifikator"
                            value="{{$data['nama_faswil']}}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Nama Perguruan Tinggi</label>
                        <select class="selectpicker form-control" name="kode_pt" data-live-search="true">
                            <!-- Tambahkan opsi kosong sebagai default -->
                            <option value="" 
                                {{ old('kode_pt', $data['kode_pt'] ?? '') == '' ? 'selected' : '' }} 
                                disabled>
                                Pilih Perguruan Tinggi
                            </option>
                            @foreach ($data_pt as $item)
                                <option value="{{$item['kodept']}}"
                                    {{ old('kode_pt', $data['kode_pt'] ?? '') == $item['kodept'] ? 'selected' : '' }}>
                                    {{$item['ptspmi']}}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nomor Induk Dosen Nasional (NIDN)</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="exampleFormControlSelect1" 
                            name="nik" 
                            value="{{$data['nik']}}"
                            placeholder="Masukkan NIDN">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Gelar Depan</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="exampleFormControlSelect1" 
                            name="gelar_depan" 
                            value="{{$data['gelar_depan']}}"
                            placeholder="Masukkan gelar depan">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Gelar Belakang</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="exampleFormControlSelect1" 
                            name="gelar_blk" 
                            value="{{$data['gelar_blk']}}"
                            placeholder="Masukkan gelar belakang">
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
        // Reinitialize the selectpicker for the new select element
        $('.selectpicker').selectpicker();

        document.getElementById('myForm').addEventListener('submit', function (e) {
            const kodeFaswil = document.getElementById('kode_faswil').value.trim();
            const namaFaswil = document.getElementById('nama_faswil').value.trim();
            const namaPerguruanTinggi = document.getElementById('kode_pt').value.trim();
            const nidn = document.getElementById('nidn').value.trim();
            const gelarDepan = document.getElementById('gelar_depan').value.trim();
            const gelarBelakang = document.getElementById('gelar_blk').value.trim();

            if (!kodeFaswil || !namaFaswil || !namaPerguruanTinggi || !nidn) {
                e.preventDefault(); // Mencegah pengiriman formulir
                alert('Field Nama Verifikator, Nama Perguruan Tinggi, dan NIDN wajib diisi!');
            }
        });

    </script>


    @endsection
</body>

</html>
