@extends('layout.index')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Penjualan Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row mb-2">
                        <div class="col-md-8 d-flex align-items-center">
                            <label for="start-date" class="mr-2">Awal:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control mr-2">
                            <label for="end-date" class="mr-2">Akhir:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control mr-2">
                            <button type="submit" class="btn btn-primary btn-sm" id="search_date"> Cari</button>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('transaksi.create') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-plus-circle"></i> Transaksi</a>
                        </div>
                    </div>
                    
                        <table class="table table-bordered table-striped datatable mt-2">
                            <thead>
                                <tr>
                                    <th>NO </th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Jenis Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <!-- Modal -->
    <form action="{{ route('transaksi.update') }}" method="GET">
        @csrf
        <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped mt-2">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Stok</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Stok Akhir</th>
                                </tr>
                            </thead>
                            <tbody id="table-show">
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="button_edit" hidden>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('javascript-bottom')
        @include('java-script.transaksi.script')
        <script>
            getTransaksi()
        </script>
    @endpush
@endsection
