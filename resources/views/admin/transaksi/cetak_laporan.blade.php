<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <title>Print Nota</title>
    </head>
    <body>
        

        <div class="print">
            <div class="card" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title text-center"><strong>{{ $toko->nama }}</strong></h5>
                    <p class="card-text text-center">{{ $toko->alamat }}</p>
			<div class="row" style="margin-bottom: -10%">
				<div class="col-sm-8">
                    <span style="font-size: 90%; margin-bottom: -25px">
                        <strong>Kasir: {{ auth()->user()->username }}</strong>
                    </span><br/>
					<span style="font-size: 70%; margin-bottom: -25px">
						<strong>{{ date('d-M-Y H:i') }}</strong>
		    		</span>
				</div>
			</div>
                </div>
                <hr>

                <ul class="list-group list-group-flush">
                    @foreach ($transaksi->tr_detail as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->nama }}</strong>
                                <small class="form-text text-small">Rp. {{ $item->harga }}</small>
                            </div>
                            <span><strong>{{ $item->qty }}X</strong></span>
                            <span><strong>Rp. {{ $item->subtotal }}</strong></span>
                        </li>
                    @endforeach
                </ul>

                <ul class="list-group list-group-flush mt-4">
                    <li class="list-group-item">Total <span class="float-right"><strong>{{ $transaksi->total }}</strong></span></li>
                    <li class="list-group-item">Tunai <span class="float-right"><strong>{{ $transaksi->bayar }}</strong></span></li>
                    <li class="list-group-item">Kembalian <span class="float-right"><strong>{{ $transaksi->kembalian }}</strong></span></li>
                </ul>

                <hr>

                   <p class="text-center">Terima Kasih</p>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <script>
            
            $(document).ready(function(){

               window.print();
            })

        </script>

    </body>
</html>