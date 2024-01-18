@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <h1>Penting hari ini</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rekening Koran</h5>
                    <h3 class="card-text">{{ number_format($rekeningKoran, 0, ',', '.') }}</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi diterima</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jurnal</h5>
                    <h3 class="card-text">{{ number_format($jurnal, 0, ',', '.') }}</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi diproses</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pembukuan</h5>
                    <h3 class="card-text">{{ number_format($pembukuan, 0, ',', '.') }}</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi dibukukan</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pelaporan</h5>
                    <h3 class="card-text">{{ number_format($pelaporan, 0, ',', '.') }}</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi dilaporkan</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8">
            <canvas id="myBarChart"></canvas>
        </div>
        <div class="col-lg-4">
            <canvas id="myPieChart"></canvas>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="card-title mt-4">Tabel Lelang</h5>
            <div class="table-responsive">
                <table class="table table-hover data-table-lelang">
                    <thead>
                        <tr>
                            <th>Nama Transaksi</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <h5 class="card-title mt-4">Tabel Piutang</h5>
            <div class="table-responsive">
                <table class="table table-hover data-table-piutang">
                    <thead>
                        <tr>
                            <th>Nama Transaksi</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {

                $.ajax({
                    type: "GET",
                    url: "{{ route('overview.barchart') }}",
                    success: function(response) {
                        const labels = response.data.map(function(e) {
                            return e.bulan
                        })

                        const data = response.data.map(function(e) {
                            return e.jumlah
                        })

                        const ctx = $('#myBarChart');
                        const config = {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah transaksi per bulan',
                                    data: data,

                                }]
                            }
                        };
                        const chart = new Chart(ctx, config);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ route('overview.piechart') }}",
                    success: function(response) {
                        const labels = response.data.map(function(e) {
                            return e.bulan
                        })

                        const data = response.data.map(function(e) {
                            return e.jumlah
                        })

                        const ctx = $('#myPieChart');
                        const config = {
                            type: 'pie',
                            data: {
                                labels: ['lelang', 'piutang'],
                                datasets: [{
                                    label: 'Jumlah transaksi per tahun',
                                    data: data,

                                }]
                            }
                        };
                        const chart = new Chart(ctx, config);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON);
                    }
                });

                const lelangTable = $('.data-table-lelang').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    searching: false,
                    info: false,
                    ajax: "{{ route('overview.lelangtable') }}",
                    columns: [{
                            data: 'nama_transaksi',
                            name: 'nama_transaksi'
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
                            data: 'saldo.toLocaleString()',
                            name: 'saldo'
                        },
                    ]
                });

                const piutangTable = $('.data-table-piutang').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    searching: false,
                    info: false,
                    ajax: "{{ route('overview.piutangtable') }}",
                    columns: [{
                            data: 'nama_transaksi',
                            name: 'nama_transaksi'
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
                            data: 'saldo.toLocaleString()',
                            name: 'saldo'
                        },
                    ]
                });

            });
        });
    </script>
@endpush
