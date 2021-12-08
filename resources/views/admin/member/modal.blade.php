<div class="modal" id="ModalMember" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control validation" name="nama" id="nama"
                            placeholder="Nama Lengkap" autofocus required>
                        <div class="invalid-feedback enama">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control validation" name="alamat" id="alamat"
                            placeholder="Alamat" required>
                        <div class="invalid-feedback ealamat">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control validation" name="kontak" id="kontak"
                            placeholder="Nomor Telepon" required>
                        <div class="invalid-feedback ekontak">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="masa" class="form-label">Masa Berlaku</label>
                        <input type="date" class="form-control validation" name="masa" id="masa"
                            placeholder="Masa Belaku" required>
                        <div class="invalid-feedback emasa">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary btnsubmit">Simpan</button>
            </div>

            </form>

        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function(e) {
            $(".btnsubmit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("input[name='id']").val();
                var nama = $("input[name='nama']").val();
                var alamat = $("input[name='alamat']").val();
                var kontak = $("input[name='kontak']").val();
                var masa = $("input[name='masa']").val();

                $.ajax({
                    url: 'members/' + id,
                    type: 'PATCH',
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
                            // window.setTimeout(function() {
                            //     location.reload();
                            // }, 1000);
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
