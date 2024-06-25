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
                    </div>
                    
                        <table class="table table-bordered table-striped mt-2" id="datatable">
                            <thead>
                                <tr>
                                    <th>NO </th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Jumlah Terjual</th>
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

    @push('javascript-bottom')
        @include('java-script.transaksi.script')
        <script>
            getReport()
        </script>
    @endpush
@endsection
