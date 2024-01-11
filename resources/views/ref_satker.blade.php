@extends('layouts.app')

@section('title', 'Referensi Satker')

@section('content')
    <div class="table-responsive">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#myModal"
            id="rekam">Rekam</a>
        <table class="table table-sm table-hover data-table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>kode</th>
                    <th>nama</th>
                    <th>nota debet</th>
                    <th>nota kredit</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="" id="myForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3" id="errorList"></div>
                        <input type="hidden" name="id" id="id" value="">
                        <div class="mb-3">
                            <label for="kode_satker" class="form-label">Kode Satker</label>
                            <input type="text" name="kode_satker" class="form-control" id="kode_satker" value="">
                        </div>
                        <div class="mb-3">
                            <label for="nama_satker" class="form-label">Nama Satker</label>
                            <input type="text" name="nama_satker" class="form-control" id="nama_satker" value="">
                        </div>
                        <div class="mb-3">
                            <label for="no_nota_debet" class="form-label">No Nota Debet</label>
                            <input type="text" name="no_nota_debet" class="form-control" id="no_nota_debet"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="no_nota_kredit" class="form-label">No Nota Kredit</label>
                            <input type="text" name="no_nota_kredit" class="form-control" id="no_nota_kredit"
                                value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnTutup">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('ref-satker.index') }}",
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'kode_satker',
                            name: 'kode_satker'
                        },
                        {
                            data: 'nama_satker',
                            name: 'nama_satker'
                        },
                        {
                            data: 'no_nota_debet',
                            name: 'no_nota_debet'
                        },
                        {
                            data: 'no_nota_kredit',
                            name: 'no_nota_kredit'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $('body').on('click', '#detail', function() {
                    const id = $(this).data('id');
                    $.get("{{ route('ref-satker.index') }}" + '/' + id, function(
                        data) {
                        $('#kode_satker').val(data.kode_satker);
                        $('#nama_satker').val(data.nama_satker);
                        $('#no_nota_debet').val(data.no_nota_debet);
                        $('#no_nota_kredit').val(data.no_nota_kredit);
                        $('#myModalLabel').html('Detail');
                        $('#btnSimpan').hide();
                        $('#errorList').html('');
                    });
                });

                $('body').on('click', '#rekam', function() {
                    $('#myForm').trigger("reset");
                    $('#myModalLabel').html('Rekam');
                    $('#btnSimpan').html('Simpan');
                    $('#btnSimpan').show();
                    $('#errorList').html('');
                });

                $('body').on('click', '#ubah', function() {
                    const id = $(this).data('id');
                    $.get("{{ route('ref-satker.index') }}" + '/' + id, function(
                        data) {
                        $('#id').val(data.id);
                        $('#kode_satker').val(data.kode_satker);
                        $('#nama_satker').val(data.nama_satker);
                        $('#no_nota_debet').val(data.no_nota_debet);
                        $('#no_nota_kredit').val(data.no_nota_kredit);
                        $('#myModalLabel').html('Ubah');
                        $('#btnSimpan').html('Ubah');
                        $('#btnSimpan').show();
                        $('#errorList').html('');
                    })
                });

                $('body').on('click', '#hapus', function() {
                    var id = $(this).data("id");
                    if (confirm('Are you sure you want to delete?')) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('ref-satker.store') }}" + '/' + id,
                            success: function(data) {
                                table.draw();
                                toastr.success('Data has been deleted successfully!');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });

                $('body').on('click', '#btnSimpan', function(e) {
                    const id = $('#id').val();
                    e.preventDefault();
                    if ($(this).html() == 'Simpan') {
                        $.ajax({
                            data: $('#myForm').serialize(),
                            url: "{{ route('ref-satker.store') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                $('#myForm').trigger("reset");
                                $('#btnTutup').click();
                                table.draw();
                                toastr.success('Data has been created successfully!');
                            },
                            error: function(data) {
                                console.log(data.responseJSON.errors);
                                var data = data.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><ul>';
                                $.each(data, function(key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>';
                                });
                                errorsHtml += '</ul></di>';
                                $('#errorList').html(errorsHtml);
                            }
                        });
                    } else {
                        $.ajax({
                            data: $('#myForm').serialize(),
                            url: "{{ route('ref-satker.index') }}" + '/' + id,
                            type: "PUT",
                            dataType: 'json',
                            success: function(data) {
                                $('#myForm').trigger("reset");
                                $('#btnTutup').click();
                                table.draw();
                                toastr.success('Data has been updated successfully!');
                            },
                            error: function(data) {
                                console.log(data.responseJSON.errors);
                                const err = data.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><ul>';
                                $.each(err, function(key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>';
                                });
                                errorsHtml += '</ul></di>';
                                $('#errorList').html(errorsHtml);
                            }
                        });
                    }
                });

            });
        });
    </script>
@endpush
