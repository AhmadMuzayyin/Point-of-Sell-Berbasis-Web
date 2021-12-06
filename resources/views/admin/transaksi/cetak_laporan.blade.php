<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
    <title>Print Nota</title>
</head>

<body>


    <div class="print">
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title text-center"><strong>{{ $toko->nama }}</strong></h5>
                <p class="card-text text-center" style="font-size: 75%">{{ $toko->alamat }}</p>
                <div class="row" style="margin-bottom: -10%">
                    <div class="col-sm">
                        <span style="font-size: 90%; margin-bottom: -25px">
                            <strong>Kasir: {{ auth()->user()->username }}</strong>
                        </span>
                    </div>
                    <div class="col-sm">
                        <span style="font-size: 70%; margin-bottom: -25px">
                            <strong>{{ date('d-m-Y H:i') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <span class="text-center"> ========================= </span>

            <table class="table">
                <tbody>
                    @foreach ($transaksi->tr_detail as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->nama }}</strong> <br><span style="font-size: 70%">Rp.
                                    {{ $item->harga }}</span>
                            </td>
                            <td>{{ $item->qty }}X</td>
                            <td>
                                <strong>Rp. {{ $item->subtotal }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <span class="text-center"> ========================= </span>

            <div class="text-end" style="margin-right: 5%; font-size: 80%">
                <span>Diskon:
                    <strong>
                        @if ($transaksi->diskon != 0)
                            {{ $transaksi->diskon }}
                        @else
                            {{ 0 }}%
                        @endif
                    </strong>
                </span><br>
                <span>Total: <strong>{{ $transaksi->total }}</strong></span><br>
                <span>Tunai: <strong>{{ $transaksi->bayar }}</strong></span><br>
                <span>Kembalian: <strong>{{ $transaksi->kembalian }}</span>
            </div>

            <h5 class="text-center my-3">Terima Kasih</h5>
        </div>
    </div>
    </div>

    <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // window.print();

        })
    </script>

</body>

</html>
