@extends('layouts.app')

@section('title', 'Referensi Menu')

@section('content')
    <div class="table-responsive">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#myModal"
            id="rekam">Rekam</a>
        <table class="table table-sm table-hover data-table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>menu</th>
                    <th>role</th>
                    <th>route</th>
                    <th>url</th>
                    <th>urut</th>
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
                            <label for="menu_name" class="form-label">Menu</label>
                            <input type="text" name="menu_name" class="form-control" id="menu_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="role_name" class="form-label">Role</label>
                            <input type="text" name="role_name" class="form-control" id="role_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="route_name" class="form-label">Route</label>
                            <input type="text" name="route_name" class="form-control" id="route_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="url_name" class="form-label">URL</label>
                            <input type="text" name="url_name" class="form-control" id="url_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="no_urut" class="form-label">Urut</label>
                            <input type="text" name="no_urut" class="form-control" id="no_urut" value="">
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
                    ajax: "{{ route('ref-menu.index') }}",
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'menu_name',
                            name: 'menu_name'
                        },
                        {
                            data: 'role_name',
                            name: 'role_name'
                        },
                        {
                            data: 'route_name',
                            name: 'route_name'
                        },
                        {
                            data: 'url_name',
                            name: 'url_name'
                        },
                        {
                            data: 'no_urut',
                            name: 'no_urut'
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
                    $.get("{{ route('ref-menu.index') }}" + '/' + id, function(
                        data) {
                        $('#menu_name').val(data.menu_name);
                        $('#role_name').val(data.role_name);
                        $('#route_name').val(data.route_name);
                        $('#url_name').val(data.url_name);
                        $('#no_urut').val(data.no_urut);
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
                    $.get("{{ route('ref-menu.index') }}" + '/' + id, function(
                        data) {
                        $('#id').val(data.id);
                        $('#menu_name').val(data.menu_name);
                        $('#role_name').val(data.role_name);
                        $('#route_name').val(data.route_name);
                        $('#url_name').val(data.url_name);
                        $('#no_urut').val(data.no_urut);
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
                            url: "{{ route('ref-menu.store') }}" + '/' + id,
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
                            url: "{{ route('ref-menu.store') }}",
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
                            url: "{{ route('ref-menu.index') }}" + '/' + id,
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
