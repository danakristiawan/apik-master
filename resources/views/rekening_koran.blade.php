@extends('layouts.app')

@section('title', 'Rekening Koran')

@section('content')
    <div class="table-responsive">
        <table class="table table-sm table-hover data-table">
            <thead>
                <tr>
                    <th>no</th>
                    <th>tanggal</th>
                    <th>bulan</th>
                    <th>tahun</th>
                    <th>tipe</th>
                    <th>jenis</th>
                    <th>kode</th>
                    <th>debet</th>
                    <th>kredit</th>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="mb-3" id="errorList"></div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="mb-3">
                                    <label for="kode_satker" class="form-label">Kode Satker</label>
                                    <input type="text" name="kode_satker" class="form-control" id="kode_satker"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_bank" class="form-label">Nama Bank</label>
                                    <input type="text" name="nama_bank" class="form-control" id="nama_bank"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                    <input type="text" name="nomor_rekening" class="form-control" id="nomor_rekening"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="text" name="tanggal" class="form-control" id="tanggal" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <input type="text" name="bulan" class="form-control" id="bulan" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" name="tahun" class="form-control" id="tahun" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe</label>
                                    <input type="text" name="tipe" class="form-control" id="tipe" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="mb-3" id="errorList"></div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <input type="text" name="jenis" class="form-control" id="jenis" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" name="kode" class="form-control" id="kode"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="debet" class="form-label">Debet</label>
                                    <input type="text" name="debet" class="form-control" id="debet"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="kredit" class="form-label">Kredit</label>
                                    <input type="text" name="kredit" class="form-control" id="kredit"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" name="status" class="form-control" id="status"
                                        value="">
                                </div>
                            </div>
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
                    ajax: "{{ route('rekening-koran.index') }}",
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'bulan',
                            name: 'bulan'
                        },
                        {
                            data: 'tahun',
                            name: 'tahun'
                        },
                        {
                            data: 'tipe',
                            name: 'tipe'
                        },
                        {
                            data: 'jenis',
                            name: 'jenis'
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'debet.toLocaleString()',
                            name: 'debet'
                        },
                        {
                            data: 'kredit.toLocaleString()',
                            name: 'kredit'
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
                    $.get("{{ route('rekening-koran.index') }}" + '/' + id, function(
                        data) {
                        $('#kode_satker').val(data.kode_satker);
                        $('#nama_bank').val(data.nama_bank);
                        $('#nomor_rekening').val(data.nomor_rekening);
                        $('#tanggal').val(data.tanggal);
                        $('#bulan').val(data.bulan);
                        $('#tahun').val(data.tahun);
                        $('#tipe').val(data.tipe);
                        $('#jenis').val(data.jenis);
                        $('#kode').val(data.kode);
                        $('#debet').val(data.debet.toLocaleString());
                        $('#kredit').val(data.kredit.toLocaleString());
                        $('#keterangan').val(data.keterangan);
                        $('#status').val(data.status);
                        $('#myModalLabel').html('Detail');
                        $('#btnSimpan').hide();
                        $('#errorList').html('');
                    });
                });

                $('body').on('click', '#proses', function() {
                    const id = $(this).data('id');
                    $.get("{{ route('rekening-koran.index') }}" + '/' + id, function(
                        data) {
                        console.log(data);
                    });
                });

            });
        });
    </script>
@endpush
