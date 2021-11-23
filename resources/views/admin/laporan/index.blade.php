@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Laporan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Laporan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">
                    <i class="fas fa-plus-circle me-1"></i>
                    Laporan
                </a>
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th>Modal</th>
                            <th>Pendapatan</th>
                            <th>Laba</th>
                            <th>Rugi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function del(id) {
            Swal.fire({
                title: 'Anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "product/" + id,
                        type: 'get',
                        data: {
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
        }
    </script>
@endpush
