@if (session('success_message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success_message') }}',
            customClass: {
                confirmButton: 'btn btn-outline-primary',
            },
            buttonsStyling: false,
        });
    </script>
@endif
<script>
    function getTransaksi() {

        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('transaksi.dataTables') }}",
                data: function(res) {
                    res.start = $('#start_date').val();
                    res.end = $('#end_date').val();
                }
            },
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "All"]
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'index',
                    fixedColumns: true,
                    width: '5%',
                    defaultContent: '-',
                    className: 'text-center',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'barang.nama',
                    name: 'barang.nama',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'stok_akhir',
                    name: 'stok_akhir',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'jumlah_terjual',
                    name: 'jumlah_terjual',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'barang.jenis_barang',
                    name: 'barang.jenis_barang',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'formatDate',
                    name: 'formatDate',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'Aksi',
                    fixedColumns: true,
                    width: '15%',
                    defaultContent: '-',
                    className: 'text-center',
                    orderable: true,
                    searchable: false
                },
            ],
        });

        $('#start_date').on('change', function() {
            var startDate = $(this).val();
            $('#end_date').attr('min', startDate);
        });

        $('#search_date').click(function() {
            var start = $('#start_date').val()
            var end = $('#end_date').val()
            if (start && end) {
                $('.datatable').DataTable().ajax.reload();
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'isikan tanggal mulai dan tanggal akhir',
                    customClass: {
                        confirmButton: 'btn btn-outline-primary',
                    },
                    buttonsStyling: false,
                })
                return false
            }
        });

    }

    function getReport() {

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('transaksi.dataTablesReport') }}",
                data: function(res) {
                    res.start = $('#start_date').val();
                    res.end = $('#end_date').val();
                }
            },
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "All"]
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'index',
                    fixedColumns: true,
                    width: '5%',
                    defaultContent: '-',
                    className: 'text-center',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'jenis_barang',
                    name: 'jenis_barang',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'jumlah_terjual',
                    name: 'jumlah_terjual',
                    fixedColumns: true,
                    defaultContent: '-',
                    className: 'text-left',
                    orderable: true,
                    searchable: false
                },
            ],
        });

        $('#start_date').on('change', function() {
            var startDate = $(this).val();
            $('#end_date').attr('min', startDate);
        });

        $('#search_date').click(function() {
            var start = $('#start_date').val()
            var end = $('#end_date').val()
            if (start && end) {
                $('#datatable').DataTable().ajax.reload();
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'isikan tanggal mulai dan tanggal akhir',
                    customClass: {
                        confirmButton: 'btn btn-outline-primary',
                    },
                    buttonsStyling: false,
                })
                return false
            }
        });

    }

    @if (isset($barang))

        var product_item = @json($barang)

        function getItem(item = null) {
            var options = '<option value="">Pilih Product</option>'
            product_item.forEach(function(data) {
                var selected = data.nama === item ? ' selected' : '';
                options += '<option value="' + data.id + '"' + selected + '>' + data.nama +
                    '</option>';
            });

            return options
        }
    @endif
    var number_content = 0
    $('#add_product').click(function() {
        var row_count = $('#myTable tbody tr').length
        number_content++
        var item_option = getItem()

        var content = `
                <tr>
                    <td> ${row_count + 1}</td>
                    <td class="table-light" width="40%">
                        <div class="form-group">
                            <select class="form-control select2 all_product" id="product_${number_content}" onchange="conditionProduct(${number_content}, this.value)">${item_option}</select>
                            <input id="product_id_${number_content}" name="product[${number_content}][idProduct]" class="d-none">
                        </div>
                    </td>
                    <td class="table-light">
                        <div class="form-group">
                            <input type="number" min="0" value="" name="product[${number_content}][qty]" id="qty_${number_content}" class="form-control text-center">
                        </div>
                    </td>
                    <td class="text-center table-light">
                        <div class="form-group">
                            <button class="btn btn-outline-success btn-xs condition_disabled" type="button" id="btn_edit_${number_content}" onclick="edit('${number_content}')" title="Edit your quantity"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-outline-danger btn-xs delete_row condition_disabled" type="button" id="btn_trash_${number_content}" title="Delete your product"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-outline-primary btn-xs" type="button" id="btn_check_${number_content}" onclick="check('${number_content}')" title="Apply your quantity" hidden><i class="fa fa-check"></i></button>
                            <button class="btn btn-outline-danger btn-xs delete_row" type="button" id="btn_times_${number_content}" title="Delete your product"><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr>
            `
        $('#table-body').append(content)

        $('#btn_edit_' + number_content).attr('hidden', true)
        $('#btn_trash_' + number_content).attr('hidden', true)
        $('#btn_check_' + number_content).attr('hidden', false)
        $('#btn_times_' + number_content).attr('hidden', false)
        $('#qty_' + number_content).attr('readonly', false)
        $('.condition_disabled').attr('disabled', true)
        $('.select2').select2();
    })

    $('#myTable').on('click', '.delete_row', function() {
        $('.condition_disabled').attr('disabled', false)

        $(this).closest('tr').remove()
        updateRowNumbers()
    })

    function updateRowNumbers() {
        $('#myTable tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1)
        })
    }

    function conditionProduct(number, value) {
        // console.log(value);
        var all_product_element = document.querySelectorAll('.all_product')
        var uniq_value = new Set()
        var has_duplicate = false

        all_product_element.forEach(function(element) {
            var element_value = element.value
            if (uniq_value.has(element_value)) {
                has_duplicate = true
                return
            }
            uniq_value.add(element_value)
        })
        if (has_duplicate) {
            Swal.fire({
                icon: 'info',
                title: 'Produk sudah ditambahkan sebelumnya',
                customClass: {
                    confirmButton: 'btn btn-outline-primary',
                },
                buttonsStyling: false,
            })
            $('#product_' + number).val("")
            $('#product_' + number).trigger('change')

            return false;

        }
        $('#product_id_' + number).val(value)
    }

    function edit(number, qty = null) {
        $('#btn_edit_' + number).attr('hidden', true)
        $('#btn_trash_' + number).attr('hidden', true)
        $('#btn_check_' + number).attr('hidden', false)
        $('#btn_times_' + number).attr('hidden', false)
        $('#qty_' + number).attr('readonly', false)
        $('.condition_disabled').attr('disabled', true)
        if (qty != null) {
            $('#product_' + number).attr('readonly', true)
        } else {
            $('#product_' + number).attr('readonly', false)
        }

    }

    function discard(number, qty = null) {
        $('#btn_edit_' + number).attr('hidden', false)
        $('#btn_trash_' + number).attr('hidden', false)
        $('#btn_check_' + number).attr('hidden', true)
        $('#btn_times_' + number).attr('hidden', true)
        $('#qty_' + number).attr('readonly', true)
        $('.condition_disabled').attr('disabled', false)

        $('#qty_' + number).val(qty)
    }

    function check(number, qty = null) {
        var cek_qty = $('#qty_' + number).val()
        var cek_product = $('#product_' + number).val()
        // console.log(cek_product);
        if (!cek_product) {
            Swal.fire({
                icon: 'info',
                title: 'Inputan produk harus diisi',
                customClass: {
                    confirmButton: 'btn btn-outline-primary',
                },
                buttonsStyling: false,
            })
            return false
        }

        if (!cek_qty) {
            Swal.fire({
                icon: 'info',
                title: 'Inputan kuantiti harus diisi',
                customClass: {
                    confirmButton: 'btn btn-outline-primary',
                },
                buttonsStyling: false,
            })
            return false
        }
        if (cek_qty == 0) {
            Swal.fire({
                icon: 'info',
                title: 'input cannot be 0',
                customClass: {
                    confirmButton: 'btn btn-outline-primary',
                },
                buttonsStyling: false,
            })
            return false
        }

        $('#btn_edit_' + number).attr('hidden', false)
        $('#btn_trash_' + number).attr('hidden', false)
        $('#btn_check_' + number).attr('hidden', true)
        $('#btn_times_' + number).attr('hidden', true)
        $('#qty_' + number).attr('readonly', true)
        $('.condition_disabled').attr('disabled', false)
        if (qty != null) {
            $('#product_' + number).attr('readonly', true)
        } else {
            $('#product_' + number).attr('disabled', true)
        }
    }

    $('#create_transaksi').submit(function(e) {
        var row_count = $('#myTable tbody tr').length
        if (row_count <= 0) {
            Swal.fire({
                icon: 'info',
                title: 'Mohon tambahkan minimal 1 produk',
                customClass: {
                    confirmButton: 'btn btn-outline-primary',
                },
                buttonsStyling: false,
            })
            return false; // Exit the forEach loop


        }
        let validate_input = true
        e.preventDefault()
        Swal.fire({
            title: 'Simpan transaksi?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-outline-primary mr-2 mb-3',
                cancelButton: 'btn btn-outline-danger mb-3',
            },
            buttonsStyling: false,
            allowOutsideClick: false,
            allowEscapeKey: false,

        }).then((result) => {
            if (result.isConfirmed) {
                $("#create_transaksi").unbind('submit').submit();
            }
        });
    })

    function modalView(param, edit = false) {
        $('#table-show').empty()
        if (edit) {
            $('#button_edit').attr('hidden', false)
        } else {
            $('#button_edit').attr('hidden', true)
        }
        $.ajax({
            url: "{{ route('transaksi.show') }}",
            type: "get",
            data: {
                id: param,
            },
            success: function(data) {
                var content = `
                <tr>
                    <th class="text-center">${data.barang.nama}</th>
                    <th class="text-center">${data.barang.jenis_barang}</th>
                    <th class="text-center">${data.barang.stok}</th>`
                if (edit) {
                    content += `
                    <th class="text-center"><input class="form-control" value="${data.jumlah_terjual}" type="number" name="qty"></th>
                    <th class="text-center"><input class="form-control" type="number" name="id" value="${param}" hidden></th>
                    `

                } else {
                    content += `
                    <th class="text-center">${data.jumlah_terjual}</th>`

                }
                content += `
                    <th class="text-center">${data.tanggal_transaksi}</th>
                    <th class="text-center">${data.stok_akhir}</th>
                </tr>`
                $('#table-show').append(content)

            },
        });

        $('#modal_view').modal('show')
    }
</script>
