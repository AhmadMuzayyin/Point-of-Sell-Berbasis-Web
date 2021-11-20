@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-2">Transaksi</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="col-md-4">
                            <div class="input-group">
                                <button class="btn btn-primary" id="Msearch" onclick="tampilProduk()">
                                    <i class="fas fa-search-plus"></i>
                                    Cari barang
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped text-center" id="table-penjualan">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Merek</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody class="body_transaksi"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-header">
                        <h3 class="card-title">Total Rp.30.000</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="input-group">
                                <span class="input-group-text" id="bayar">Rp.</span>
                                <input type="text" class="form-control" name="bayar" id="bayar" value="50.000"
                                    placeholder="Bayar" aria-label="Bayar">
                                <button class="btn btn-success" name="selesai" id="selesai"><i
                                        class="fas fa-check"></i></button>
                            </div>
                        </form>
                        <h5 class="text-bold mt-3">Kembalian : Rp.20.000</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.transaksi.produk')
    <style>
        #qty {
            padding: unset;
            font-size: unset;
            display: unset;
        }

    </style>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#selesai').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Success',
                    text: "Transaksi selesai! ",
                    icon: 'success',
                    showCancelButton: false,
                    showConfirmButton: false,
                })
                window.setTimeout(function() {
                    location.reload();
                }, 1500);
            });
        });

        function navtoggled() {
            $('.body').addClass("sb-sidenav-toggled");
        }

        function tampilProduk() {
            $('#ModalSearch').modal('show');
            const datatablesSimple = document.getElementById('table-produk');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        }
    </script>
@endpush
