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
                                    <th>Modal</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody class="body_transaksi">
                                @if ($datas !== null)
                                    @foreach ($datas->tr_detail as $item)
                                        <tr id="tr-{{ $item->id }}">
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->merek }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td class="col-1">
                                                <input type="number" name="qty" id="qty-{{ $item->id }}"
                                                    data-id="{{ $item->id }}" data-product="{{ $item->product_id }}"
                                                    class="form-control w-100 qty-{{ $item->id }}"
                                                    onkeyup="hitungSubtotal({{ $item->id }})"
                                                    value="{{ $item->qty }}" data-kue="{{ $item->harga }}">
                                            </td>
                                            <td class="harga-{{ $item->id }}" data-id="{{ $item->id }}">
                                                {{ $item->subtotal }}
                                            </td>
                                            <td>
                                                <button class="badge bg-danger btn_hapus"
                                                    data-transaksi="{{ $item->transactions_id }}"
                                                    data-id="{{ $item->id }}" style="border: 0px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-header">
                        <h3 class="card-title">Total Rp. <span class="total_harga"
                                id="total">{{ $datas ? $datas->total : '' }}</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            {{-- <label for="diskonInput" class="form-label">Diskon ( % )</label> --}}
                            <input type="number" class="form-control" name="idMember" id="idMember"
                                placeholder="Masukkan ID Member" aria-label="idMember" autocomplete="off"
                                value="{{ $datas ? $datas->id_member : '' }}">
                            <button class="btn btn-warning" type="button" onclick="tampilMember()">Check</button>
                        </div>
                        <div class="mb-3">
                            <label for="diskonInput" class="form-label">Diskon</label>
                            <input type="number" class="form-control" name="diskonInput" id="diskonInput"
                                aria-label="diskonInput" autocomplete="off" readonly
                                value="{{ $datas ? $datas->diskon : '0' }}">
                        </div>
                        <div class="mb-3">
                            <label for="diskonInput" class="form-label">Bayar</label>
                            <input type="text" class="form-control" name="bayar" id="bayarInput" placeholder="Bayar"
                                aria-label="Bayar" autocomplete="off">
                        </div>
                        <h5 class="text-bold mb-3">Kembalian : <span class="kembalian"></span></h5>
                        <button class="btn btn-success" type="button" name="selesai" id="selesai"
                            data-kue="{{ $datas ? $datas->id : '' }}"><i class="fas fa-check"></i> Cetak Nota</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.transaksi.member')
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
        function tampilMember() {
            let val = $('#idMember').val()

            $.ajax({
                type: "GET",
                url: "{{ route('cek.member') }}",
                data: {
                    val: val
                },
                success: function(res) {
                    if (res.status == 'expired') {
                        Swal.fire('Sorry', 'Masa Berlaku Member Sudah Expired', 'warning')
                    }

                    if (res.status == 'false') {
                        Swal.fire('Sorry', 'Member Tersebut Tidak Terdaftar', 'warning')
                    }

                    if (res.status == 'true') {
                        $('#diskonInput').val(res.diskon)
                        location.reload()
                    }

                }
            });

        }

        function tampilProduk() {
            $('#ModalSearch').modal('show');
            const datatablesSimple = document.getElementById('table-produk');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        }

        $(document).on('keyup', '#bayarInput', function() {

            let val = $(this).val()
            let total = $('.total_harga').text()

            let kembalian = parseInt(val) - total

            let back = $('.kembalian').text(kembalian)

        })

        $(document).on('change', '#diskonInput', function() {

            let id = $(this).data('kue')
            let total = parseInt($('.total_harga').text())
            let diskonInput = parseInt($('#diskonInput').val())
            let hitung_diskon = total * diskonInput / 100
            let totalDiskon = total - hitung_diskon

            $('.total_harga').text(totalDiskon)

            $.ajax({
                type: "GET",
                url: "{{ route('diskon.product') }}",
                data: {
                    id: id,
                    diskon: hitung_diskon,
                    total: totalDiskon,
                    inputDiskon: diskonInput,
                },
                success: function(res) {

                }
            });

        })

        $(document).on('click', '#selesai', function() {

            let id = $(this).data('kue')
            let bayar = $('#bayarInput').val()
            let kembalian = $('.kembalian').text()


            if (!$('#diskonInput').is(':disabled')) {
                let diskon = $('#diskonInput').val()

                if (bayar == '') {

                    Swal.fire('Sorry', 'Input Uang Pelanggan Dahulu', 'warning')

                } else {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('selesai.product') }}",
                        data: {
                            id: id,
                            bayar: bayar,
                            kembalian: kembalian,
                        },
                        success: function(res) {

                            const newWindow = window.open('{{ url('cetak-transaksi') }}?data=' +
                                id, 'Cetak Nota',
                                `
                                        scrollbars=yes,
                                        width  = 700, 
                                        height = 700, 
                                        top    = 500, 
                                        left   = 500
                                    `
                            );

                            if (window.open) newWindow.print();

                            location.reload();

                        }
                    });

                }

            } else {
                if (bayar == '') {

                    Swal.fire('Sorry', 'Input Uang Pelanggan Dahulu', 'warning')

                } else {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('selesai.product') }}",
                        data: {
                            id: id,
                            bayar: bayar,
                            kembalian: kembalian,
                        },
                        success: function(res) {

                            const newWindow = window.open('{{ url('cetak-transaksi') }}?data=' + id,
                                'Cetak Nota',
                                `
                                    scrollbars=yes,
                                    width  = 700, 
                                    height = 700, 
                                    top    = 500, 
                                    left   = 500
                                `
                            );

                            if (window.open) newWindow.print();

                            location.reload();

                        }
                    });

                }

            }


        })
    </script>
@endpush
