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
                <h6 class="m-0 font-weight-bold text-primary">Edit Admin</h6>
            </div>
            <div class="card-body">
                <!-- Form untuk update username -->
                <form action="{{ route('admin.updateUsername', $data['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="username" 
                            name="username" 
                            value="{{ $data['username'] }}" 
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Username</button>
                </form>

                <hr>

                <!-- Form untuk update password -->
                <form action="{{ route('admin.updatePassword', $data['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="current_password" 
                            name="current_password" 
                            required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="new_password" 
                            name="new_password" 
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>

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
    </script>
    @endsection
</body>

</html>
