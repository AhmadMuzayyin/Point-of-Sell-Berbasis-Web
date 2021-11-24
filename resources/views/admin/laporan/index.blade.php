@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Laporan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Laporan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="laporan">Laporan Berdasarkan</label>
                        <select class="form-select" id="laporan" aria-label="Default select example">
                            <option value="">Laporan</option>
                            <option value="1">Tanggal</option>
                            <option value="2">Bulan</option>
                            <option value="3">Tahun</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <h2>Laporan Berdasarkan selected</h2>
                    <p>Modal : Data</p>
                    <p>Pendapatan : Data</p>
                    <p>Laba : Data</p>
                    <p>Rugi : Data</p>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fas fa-file-pdf"></i>
                            Cetak Laporan
                        </button>
                    </div>
                </div>
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
                    <table class="table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Merek</th>
                                <th scope="col">Modal</th>
                                <th scope="col">Pendapatan</th>
                                <th scope="col">Laba</th>
                                <th scope="col">Rugi</th>
                                <th scope="col">Kasir</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
