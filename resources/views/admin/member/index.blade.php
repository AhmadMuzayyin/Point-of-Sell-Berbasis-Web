@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Member</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Member</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('members.create') }}" role="button">
                    <i class="fas fa-plus-circle me-1"></i>
                    Member
                </a>
                <a class="btn btn-success" href="{{ route('cetak.member') }}" role="button">
                    <i class="fas fa-print"></i>
                    Cetak
                </a>
            </div>
            <div class="card-body">
                <table class="table text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Hp</th>
                            <th>Masa Belaku</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->id_member }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->alamat }}</td>
                                <td>{{ $b->kontak }}</td>
                                <td>
                                    @if ($b->masa_berlaku >= date('Y-m-d'))
                                        {{ $b->masa_berlaku }}
                                    @else
                                        Kartu Member
                                    @endif
                                </td>
                                <td>
                                    <button class="badge bg-success d-inline cetak-member" style="border: 0"
                                        data-id="{{ $b->id_member }}">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="badge bg-primary d-inline editMember" style="border: 0;"
                                        data-bs-toggle="modal" data-bs-target="#ModalMember" data-id="{{ $b->id_member }}"
                                        data-nama="{{ $b->nama }}" data-alamat="{{ $b->alamat }}"
                                        data-kontak="{{ $b->kontak }}" data-masa="{{ $b->masa_berlaku }}">
                                        <span><i class="fas fa-pencil-alt"></i></span>
                                    </button>
                                    <form action="{{ route('members.destroy', $b->id) }}" method="POST"
                                        class=" d-inline">
                                        @csrf
                                        <button type="submit" class="badge bg-danger btndelete" style="border: 0px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.member.modal')

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.cetak-member').click(function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                const newWindow = window.open("{{ url('cetak-laporan') }}/" + id);
            });

            $('.editMember').click(function(e) {
                e.preventDefault();

                $('#id').val($(this).data('id'));
                $('#nama').val($(this).data('nama'));
                $('#alamat').val($(this).data('alamat'));
                $('#kontak').val($(this).data('kontak'));
                $('#masa').val($(this).data('masa'));

            });

            $(".btndelete").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var Url = $(this).parents('form').attr('action');

                Swal.fire({
                    title: 'Hapus data?',
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Close`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: Url,
                            type: 'DELETE',
                            data: {
                                _token: _token
                            },
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    Swal.fire({
                                        title: data.success,
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
                    }
                })

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
