@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h2 class="mt-3" style="margin-left: 16px">Tambah Member</h2>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Barang</li>
        </ol> --}}
        <div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form>
                            @csrf
                            <div class="mb-3">
                                <label for="id" class="form-label">ID Member</label>
                                <input type="text" class="form-control validation" name="id" value="{{ $memberID }}"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control validation" name="nama" placeholder="Nama Lengkap"
                                    autofocus required>
                                <div class="invalid-feedback enama">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control validation" name="alamat" placeholder="Alamat"
                                    required>
                                <div class="invalid-feedback ealamat">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control validation" name="kontak"
                                    placeholder="Nomor Telepon" required>
                                <div class="invalid-feedback ekontak">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="masa" class="form-label">Masa Berlaku</label>
                                <input type="date" class="form-control validation" name="masa" placeholder="Masa Belaku"
                                    required>
                                <div class="invalid-feedback emasa">
                                </div>
                            </div>
                            <a class="btn btn-secondary" href="{{ route('members.index') }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" style="margin-bottom: 15%"
                                    fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                </svg>
                            </a>
                            <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
                        </form>
                    </div>
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
                var id = $("input[name='id']").val();
                var nama = $("input[name='nama']").val();
                var alamat = $("input[name='alamat']").val();
                var kontak = $("input[name='kontak']").val();
                var masa = $("input[name='masa']").val();

                $.ajax({
                    url: "{{ route('members.store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        id: id,
                        nama: nama,
                        alamat: alamat,
                        kontak: kontak,
                        masa: masa,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.success,
                                icon: 'success',
                                showConfirmButton: false
                            })
                            window.setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });

                function printErrorMsg(msg) {
                    $('.validation').addClass('is-invalid');
                    $.each(msg, function(key, value) {
                        cek(key, value);
                    });
                }

            });

            function cek(key, value) {
                if (key === 0) {
                    $(".eid").html(value);
                } else if (key === 1) {
                    $(".enama").html(value);
                } else if (key === 2) {
                    $(".ealamat").html(value);
                } else if (key === 3) {
                    $(".ekontak").html(value);
                } else {
                    $(".emasa").html(value);
                }
            }

        });
    </script>
@endpush
