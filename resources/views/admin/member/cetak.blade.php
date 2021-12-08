<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Kartu Member</title>

    <link href="{{ url('assets/css/simple-datatables.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/bootstrap-icons.css') }}" rel="stylesheet" />
    {{-- Font Awesaome --}}
    <script src="{{ url('assets/js/all.min.js') }}" crossorigin="anonymous"></script>
    <style>
        .card {
            background-color: rgb(0, 195, 255)
        }

        .card span {
            font-size: 90%;
        }

    </style>
</head>

<body>


    @foreach ($member as $m)
        <div class="card my-2 mx-2" style="max-width: 350px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ url('uploads/profil.png') }}" class="img-fluid" alt="profil">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $m->nama }}</h5>
                        <span>ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{ $m->id_member }}</span><br>
                        <span>Alamat &nbsp;&nbsp;: {{ $m->alamat }}</span><br>
                        <span>No Hp &nbsp;&nbsp;&nbsp;: {{ $m->kontak }}</span><br>
                        <span>
                            <small style="font-size: 70%; margin-left: 40%;">Berlaku
                                sampai</small><br>
                            <small style="font-size: 60%; margin-left: 47%">{{ $m->masa_berlaku }}</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>
    <script src="{{ url('assets/js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ url('assets/js/simple-datatables@latest.js') }}"></script>
    <script src="{{ url('assets/js/datatables-simple-demo.js') }}"></script>
    <script src="{{ url('assets/js/sweetalert2.all.min.js') }}"></script>
</body>

</html>
