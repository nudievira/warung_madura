@extends('layout.index')

{{-- <style>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Opsional: Jika ingin memberi jarak pada tombol */
    .btn {
        margin-left: auto;
    }

    .cancel {
        margin-left: 10px;

    }
</style> --}}
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form id="create_transaksi" method="POST" class="mt-3" action="{{ route('transaksi.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buat Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <label>Daftar Barang</label>
                                <button class="btn btn-sm btn-success mb-2 condition_disabled" id="add_product"><i
                                        class="fas fa-plus-circle"></i>
                                    Tambah</button>
                            </div>
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>NO </th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">

                                </tbody>
                            </table>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="justify-content-end px-3" style="text-align: end">
                        <button class="btn btn-outline-primary btn-sm condition_disabled" id="">Kirim</button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        @push('javascript-bottom')
        @include('java-script.transaksi.script')
        @endpush
    @endsection
