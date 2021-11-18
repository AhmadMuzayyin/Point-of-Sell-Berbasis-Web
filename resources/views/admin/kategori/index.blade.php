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
                        @foreach ($data as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>
                                    <form action="category/{{ $k->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger" style="border: 0px;"
                                            onclick="alert('Apakah anda yakin?')">
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
                            alert(data.success);
                            window.location.reload();
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

        });
    </script>
@endpush
