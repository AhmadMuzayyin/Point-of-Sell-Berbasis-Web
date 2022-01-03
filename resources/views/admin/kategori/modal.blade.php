<div class="modal" id="ModalKategori" tabindex="-1">
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
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control validation" name="kategori" id="kategori"
                            placeholder="Kategori" autofocus required>
                        <div class="invalid-feedback ekategori">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <input type="text" class="form-control validation" name="jenis" id="jenis" placeholder="Jenis"
                            required>
                        <div class="invalid-feedback ejenis">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary upKategori">Simpan</button>
            </div>

            </form>

        </div>
    </div>
</div>



@push('script')
    <script>
        $(document).ready(function(e) {
            $(".upKategori").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("#id").val();
                var kategori = $("#kategori").val();
                var jenis = $("#jenis").val();

                $.ajax({
                    url: 'category/' + id,
                    type: 'PATCH',
                    data: {
                        _token: _token,
                        id: id,
                        kategori: kategori,
                        jenis: jenis,
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
                    $(".ekategori").html(value);
                } else {
                    $(".ejenis").html(value);
                }
            }

        });
    </script>
@endpush
