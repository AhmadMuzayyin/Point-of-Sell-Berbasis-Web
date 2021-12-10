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
            background: rgb(111, 0, 255);
            background: linear-gradient(90deg, rgba(111, 0, 255, 1) 0%, rgba(195, 0, 215, 1) 50%, rgba(255, 0, 91, 1) 100%);
        }

        .card span {
            font-size: 90%;
            color: #fff
        }

    </style>
</head>

<body>


    @foreach ($member as $m)
        <div class="card my-2 mx-2" style="max-width: 350px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ url('uploads/profil.png') }}" class="img-fluid mt-2" alt="profil">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-white">{{ $m->nama }}</h5>
                        <span>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{ $m->id_member }}</span><br>
                        <span>Alamat &nbsp;&nbsp;: {{ $m->alamat }}</span><br>
                        <span>No Hp &nbsp;&nbsp;&nbsp;: {{ $m->kontak }}</span><br>
                        <span>
                            <small style="margin-left: -54%;">{{ $m->masa_berlaku }}</small>
                            <span style="font-size: 90%;  margin-left: 20%;">
                                <span class=" badge rounded-pill bg-primary">
                                    {{ $toko->nama }}
                                </span>
                            </span>
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
