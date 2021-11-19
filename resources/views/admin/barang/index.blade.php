@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Barang</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">
                    <i class="fas fa-plus-circle me-1"></i>
                    Barang
                </a>
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->merek }}</td>
                                <td>{{ $b->harga_beli }}</td>
                                <td>{{ $b->harga_jual }}</td>
                                <td>{{ $b->category->nama }}</td>
                                <td>{{ $b->stok }}</td>
                                <td>
                                    <form action="{{ route('product.destroy', $b->id) }}" method="POST">
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
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(e) {
            $(".btndelete").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("input[name='id']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Anda yakin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: Url,
                            type: 'DELETE',
                            data: {
                                _token: _token,
                                id: id,
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    // alert(data.success);
                                    Swal.fire({
                                        title: data.success,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1500);
                                }
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
