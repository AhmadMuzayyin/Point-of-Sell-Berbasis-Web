@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus-circle me-1"></i>
                    Kategori
                </a>
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($category as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>
<<<<<<< HEAD
                                    <form action="{{ route('category.destroy', $k->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="badge bg-danger btndelete" style="border: 0px;">
=======
                                    <form action="{{ route('category.destroy', $k->id) }}}}" method="POST">
                                        @csrf
                                        <button class="badge bg-danger btndelete" style="border: 0px;">
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control validation" name="nama" placeholder="Nama Kategori">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $(document).ready(function(e) {
            $("#btnsubmit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var nama = $("input[name='nama']").val();

                $.ajax({
                    url: "{{ route('category.store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        nama: nama,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
<<<<<<< HEAD
                                title: 'Success',
                                text: data.success,
                                icon: 'success',
                                showConfirmButton: false
                            })
                            window.setTimeout(function() {
                                location.reload();
                            }, 1000);
=======
                                title: 'Success!',
                                title: data.success,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.setTimeout(function() {
                                location.reload();
                            }, 1500);
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        $(".invalid-feedback").html(value);
                    });
                }
            });

            $(".btndelete").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
<<<<<<< HEAD
                var _method = $("input[name='_method']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Hapus data?',
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Close`,
=======
                var id = $("input[name='id']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Anda yakin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes'
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: Url,
                            type: 'DELETE',
                            data: {
<<<<<<< HEAD
                                _token: _token
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
=======
                                _token: _token,
                                id: id,
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    // alert(data.success);
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
                                    Swal.fire({
                                        title: 'Success!',
                                        title: data.success,
                                        icon: 'success',
<<<<<<< HEAD
                                        showConfirmButton: false
                                    })
                                    window.setTimeout(function() {
                                        location.reload();
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
=======
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        title: data.error,
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1500);
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
                                }
                            }
                        });
                    }
                })
<<<<<<< HEAD

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        $(".invalid-feedback").html(value);
                    });
                }
=======
>>>>>>> 7ffd9331e894b6c1ca2a405687dd28c12913a221
            });
        });
    </script>
@endpush
