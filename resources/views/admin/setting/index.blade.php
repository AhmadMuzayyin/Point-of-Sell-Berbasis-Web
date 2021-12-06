@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengaturan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
        <div class="row">
            <div class="col-md-7">
                @if (Request::is('user'))
                    <div class="card mb3">
                        <div class="card-body">
                            <h4>Tambah Pengguna</h4>
                            <form class="form-user">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control validation" name="name"
                                        placeholder="Nama Lengkap">
                                    <div class="invalid-feedback ename">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control validation" name="username"
                                        placeholder="Username">
                                    <div class="invalid-feedback eusername">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control validation" name="password"
                                        placeholder="Password">
                                    <div class="invalid-feedback epassword">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <select class="form-select validation" name="status" id="status"
                                        aria-label="Default select example" required>
                                        <option selected value="">Pilih kategori barang</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Kasir</option>
                                    </select>
                                    <div class="invalid-feedback ecategory">
                                    </div>
                                </div>
                                <a class="btn btn-secondary" href="{{ route('setting.index') }}" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        style="margin-bottom: 15%" fill="currentColor" class="bi bi-arrow-left-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                    </svg>
                                </a>
                                <button type="submit" class="btn btn-primary adduser">Submit</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-header">
                            {{-- <h3>Data Kasir</h3> --}}
                            <a href="{{ route('user.index') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i>
                                Pengguna
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="text-center" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th><i class="fas fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $k)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $k->name }}</td>
                                            <td>{{ $k->username }}</td>
                                            <td>
                                                @if ($k->status > 1)
                                                    Kasir
                                                @else
                                                    Administrator
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('user.destroy', $k->id) }}" method="POST">
                                                    @csrf
                                                    <button class="badge bg-danger btndelete" style="border: 0px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md">
                @if (Request::is('settingEdit/1') == true)
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @elseif (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @foreach ($data as $d)
                                {{-- <form action="{{ route('setting.update', $d->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                <form action="{{ route('setting.update', $d->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{-- @method('patch') --}}
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $d->id }}">
                                    <div class="mb-3">
                                        <label for="NamaToko" class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" id="NamaToko" name="nama"
                                            placeholder="{{ $d->nama }}" required autofocus
                                            value="{{ $d->nama }}">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="Alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="Alamat" name="alamat"
                                            placeholder="{{ $d->alamat }}" required value="{{ $d->alamat }}">
                                    </div>
                                    <a class="btn btn-secondary" href="{{ route('setting.index') }}" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            style="margin-bottom: 15%" fill="currentColor"
                                            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                        </svg>
                                    </a>
                                    <button type="submit" class="btn btn-primary btnsubmit">Simpan</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="card mb-3">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Toko</th>
                                        <th>Alamat</th>
                                        <th><i class="fas fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $set)
                                        <tr>
                                            <td>{{ $set->nama }}</td>
                                            <td>{{ $set->alamat }}</td>
                                            <td>
                                                <a href="{{ url('settingEdit' . '/' . $set->id) }}" type="submit"
                                                    class="badge bg-primary text-decoration-none" style="border: 0px;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $(".adduser").click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var status = document.getElementById("status").value;

            $.ajax({
                url: "{{ route('user.store') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    name: name,
                    username: username,
                    password: password,
                    status: status
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.success,
                            icon: 'success',
                            showConfirmButton: false
                        })
                        window.setTimeout(function() {
                            window.location.href = "{{ route('setting.index') }}"
                        }, 1000);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $('.validation').addClass('is-invalid');
            $.each(msg, function(key, value) {
                cek(key, value);
            });
        }

        function cek(key, value) {
            if (key === 0) {
                $(".ename").html(value);
            } else if (key === 1) {
                $(".eusername").html(value);
            } else if (key === 2) {
                $(".epassword").html(value);
            } else {
                $(".estatus").html(value);
            }
        }
        $(document).ready(function(e) {
            $(".btnsubmit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var nama = $("input[name='nama']").val();
                var alamat = $("input[name='alamat']").val();
                var nota = $('select[name=nota] option').filter(':selected').val();
                var Url = $(this).parents('form').attr('action');

                $.ajax({
                    type: 'PATCH',
                    url: Url,
                    data: {
                        _token: _token,
                        nama: nama,
                        alamat: alamat,
                        nota: nota,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.success,
                                icon: 'success',
                                showConfirmButton: false
                            })
                            window.setTimeout(function() {
                                window.location.href = "{{ route('setting.index') }}"
                            }, 1000);
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.error,
                                icon: 'error',
                                showConfirmButton: false
                            })
                            window.setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                });

            });

            $(".btndelete").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Hapus data?',
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Close`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: Url,
                            type: 'DELETE',
                            data: {
                                _token: _token
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    Swal.fire({
                                        title: data.success,
                                        icon: 'success',
                                        showConfirmButton: false
                                    })
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    printErrorMsg(data.error);
                                }
                            }
                        });
                    }
                })

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        $(".invalid-feedback").html(value);
                    });
                }
            });

        });
    </script>
@endpush
