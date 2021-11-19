@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengaturan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @elseif (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @foreach ($data as $d)
                        {{-- <form action="{{ route('setting.update', $d->id) }}" method="POST" enctype="multipart/form-data"> --}}
                        <form action="{{ route('setting.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $d->id }}">
                            <div class="mb-3">
                                <label for="NamaToko" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="NamaToko" name="nama"
                                    placeholder="{{ $d->nama }}" required autofocus value="{{ $d->nama }}">
                            </div>
                            <div class=" mb-3">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="Alamat" name="alamat"
                                    placeholder="{{ $d->alamat }}" required value="{{ $d->alamat }}">
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Gambar / Logo Toko</label>
                                <input class="form-control" type="file" id="logo" name="logo" required
                                    value="{{ $d->logo }}">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="nota" name="nota" aria-label="Default select example">
                                    <option selected value="">Ukuran Nota</option>
                                    <option value="1">Kecil</option>
                                    <option value="2">Besar</option>
                                </select>
                            </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
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
                var _method = $("input[name='_method']").val();
                var id = $("input[name='id']").val();
                var nama = $("input[name='nama']").val();
                var alamat = $("input[name='alamat']").val();
                var logo = $("input[name='logo']").val();
                var nota = $("input[name='nota']").val();
                var Url = $(this).parents('form').attr('action');
                console.log(Url)

                $.ajax({
                    type: 'POST',
                    url: Url,
                    data: {
                        _token: _token,
                        _method: _method,
                        nama: nama,
                        alamat: alamat,
                        logo: logo,
                        nota: nota,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success);
                            // window.location.reload();
                        } else {
                            // printErrorMsg(data.error);
                            alert(data.error);
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
