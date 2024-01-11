@extends('layouts.app')

@section('title', 'Referensi Bank')

@section('content')
    <div class="table-responsive">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#myModal"
            id="rekam">Rekam</a>
        <table class="table table-sm table-hover data-table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>kode</th>
                    <th>nomor</th>
                    <th>uraian</th>
                    <th>jenis</th>
                    <th>nama</th>
                    <th>surat</th>
                    <th>tanggal</th>
                    <th>status</th>
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
                            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" class="form-control" id="nomor_rekening"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="uraian_rekening" class="form-label">Uraian Rekening</label>
                            <input type="text" name="uraian_rekening" class="form-control" id="uraian_rekening"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_rekening" class="form-label">Jenis Rekening</label>
                            <input type="text" name="jenis_rekening" class="form-control" id="jenis_rekening"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="nama_bank" class="form-label">Nama Bank</label>
                            <input type="text" name="nama_bank" class="form-control" id="nama_bank" value="">
                        </div>
                        <div class="mb-3">
                            <label for="surat_izin" class="form-label">Surat Izin</label>
                            <input type="text" name="surat_izin" class="form-control" id="surat_izin" value="">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="text" name="tanggal_surat" class="form-control" id="tanggal_surat"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="status_rekening" class="form-label">Status Rekening</label>
                            <input type="text" name="status_rekening" class="form-control" id="status_rekening"
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
                    ajax: "{{ route('ref-bank.index') }}",
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
                            data: 'nomor_rekening',
                            name: 'nomor_rekening'
                        },
                        {
                            data: 'uraian_rekening',
                            name: 'uraian_rekening'
                        },
                        {
                            data: 'jenis_rekening',
                            name: 'jenis_rekening'
                        },
                        {
                            data: 'nama_bank',
                            name: 'nama_bank'
                        },
                        {
                            data: 'surat_izin',
                            name: 'surat_izin'
                        },
                        {
                            data: 'tanggal_surat',
                            name: 'tanggal_surat'
                        },
                        {
                            data: 'status_rekening',
                            name: 'status_rekening'
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
                    $.get("{{ route('ref-bank.index') }}" + '/' + id, function(
                        data) {
                        $('#kode_satker').val(data.kode_satker);
                        $('#nomor_rekening').val(data.nomor_rekening);
                        $('#uraian_rekening').val(data.uraian_rekening);
                        $('#jenis_rekening').val(data.jenis_rekening);
                        $('#nama_bank').val(data.nama_bank);
                        $('#surat_izin').val(data.surat_izin);
                        $('#tanggal_surat').val(data.tanggal_surat);
                        $('#status_rekening').val(data.status_rekening);
                        $('#myModalLabel').html('Detail');
                        $('#btnSimpan').hide();
                        $('#errorList').html('');
                    });
                });

                $('body').on('click', '#rekam', function() {
                    $('#myForm').trigger("reset");
                    $('#myModalLabel').html('Rekam');
                    $('#btnUbah').hide();
                    $('#btnSimpan').html('Simpan');
                    $('#btnSimpan').show();
                    $('#errorList').html('');
                });

                $('body').on('click', '#ubah', function() {
                    const id = $(this).data('id');
                    $.get("{{ route('ref-bank.index') }}" + '/' + id, function(
                        data) {
                        $('#id').val(data.id);
                        $('#kode_satker').val(data.kode_satker);
                        $('#nomor_rekening').val(data.nomor_rekening);
                        $('#uraian_rekening').val(data.uraian_rekening);
                        $('#jenis_rekening').val(data.jenis_rekening);
                        $('#nama_bank').val(data.nama_bank);
                        $('#surat_izin').val(data.surat_izin);
                        $('#tanggal_surat').val(data.tanggal_surat);
                        $('#status_rekening').val(data.status_rekening);
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
                            url: "{{ route('ref-bank.store') }}" + '/' + id,
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
                            url: "{{ route('ref-bank.store') }}",
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
                                const err = data.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><ul>';
                                $.each(err, function(key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>';
                                });
                                errorsHtml += '</ul></di>';
                                $('#errorList').html(errorsHtml);
                            }
                        });
                    } else {
                        $.ajax({
                            data: $('#myForm').serialize(),
                            url: "{{ route('ref-bank.index') }}" + '/' + id,
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
                                var data = data.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><ul>';
                                $.each(data, function(key, value) {
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
