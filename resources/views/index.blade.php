@extends('layouts.header')

@section('content')
    <div class="container-fluid px-4">
        <h1 class=" mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h3>Selamat datang kembali {{ $user->name }}.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('product.cek') }}",
                type: 'GET',
                context: document.body,
                // success: function(data) {
                //     if ($.isEmptyObject(data.error)) {
                //         alert(data.success);
                //     } else {
                //         alert(data.error)
                //     }
                // }
            });
        });
    </script>
@endpush
