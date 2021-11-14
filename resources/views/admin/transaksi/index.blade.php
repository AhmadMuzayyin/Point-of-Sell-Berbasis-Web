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
                                <input type="text" class="form-control" name="search" id="search"
                                    placeholder="cari barang">
                                <button class="btn btn-primary" id="Msearch" onclick="tampilProduk()">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="text-center" id="table-penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Merek</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Merek</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tali Rafia</td>
                                    <td>Gajah Duduk</td>
                                    <td>10.000</td>
                                    <td class="col-1">
                                        <form action="">
                                            <input type="number" name="qty" id="qty" class="form-control">
                                        </form>
                                    </td>
                                    <td>10.000</td>
                                    <td>
                                        <button class="badge bg-danger" style="border: 0px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Tali Rafia</td>
                                    <td>Gajah Duduk</td>
                                    <td>10.000</td>
                                    <td class="col-1">
                                        <form action="">
                                            <input type="number" name="qty" id="qty" class="form-control">
                                        </form>
                                    </td>
                                    <td>10.000</td>
                                    <td>
                                        <button class="badge bg-danger" style="border: 0px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Tali Rafia</td>
                                    <td>Gajah Duduk</td>
                                    <td>10.000</td>
                                    <td class="col-1">
                                        <form action="">
                                            <input type="number" name="qty" id="qty" class="form-control">
                                        </form>
                                    </td>
                                    <td>10.000</td>
                                    <td>
                                        <button class="badge bg-danger" style="border: 0px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
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
                        <form action="">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                <input type="text" class="form-control" name="bayar" id="bayar" value="50.000"
                                    placeholder="Bayar" aria-label="Bayar">
                                <button class="btn btn-success"><i class="fas fa-check"></i></button>
                            </div>
                        </form>
                        <h5 class="text-bold mt-3">Kembalian : Rp.20.000</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.transaksi.produk')

@endsection
@push('script')
    <script>
        function navtoggled() {
            $('.body').addClass("sb-sidenav-toggled");
        }
        const datatablesSimple = document.getElementById('table-penjualan');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
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
