@extends('layouts.app')

@section('title', 'Ref User Page')

@section('content')
    <div class="table-responsive">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#myModal"
            id="rekam">Rekam</a>
        <table class="table table-sm table-hover data-table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>nip</th>
                    <th>satker</th>
                    <th>role</th>
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
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="">
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" id="nip" value="">
                        </div>
                        <div class="mb-3">
                            <label for="kode_satker" class="form-label">Kode Satker</label>
                            <input type="text" name="kode_satker" class="form-control" id="kode_satker" value="">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" id="role" value="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="">
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
                    ajax: "{{ route('user.index') }}",
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nip',
                            name: 'nip'
                        },
                        {
                            data: 'kode_satker',
                            name: 'kode_satker'
                        },
                        {
                            data: 'role',
                            name: 'role'
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
                    $.get("{{ route('user.index') }}" + '/' + id, function(
                        data) {
                        $('#nama').val(data.nama);
                        $('#nip').val(data.nip);
                        $('#kode_satker').val(data.kode_satker);
                        $('#role').val(data.role);
                        $('#password').val(data.password);
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
                    $.get("{{ route('user.index') }}" + '/' + id, function(
                        data) {
                        $('#id').val(data.id);
                        $('#nama').val(data.nama);
                        $('#nip').val(data.nip);
                        $('#kode_satker').val(data.kode_satker);
                        $('#role').val(data.role);
                        $('#password').val(data.password);
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
                            url: "{{ route('user.store') }}" + '/' + id,
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
                            url: "{{ route('user.store') }}",
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
                            url: "{{ route('user.index') }}" + '/' + id,
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
