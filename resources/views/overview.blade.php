@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <h1>Penting hari ini</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rekening Koran</h5>
                    <h3 class="card-text">346</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi diterima</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jurnal</h5>
                    <h3 class="card-text">43</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi diproses</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pembukuan</h5>
                    <h3 class="card-text">56</h3>
                    <h6 class="card-subtitle mb-2 text-body-secondary">transaksi dibukukan</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pelaporan</h5>
                    <h3 class="card-text">436</h3>
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
            <h5 class="card-title mt-4">Pembukuan Lelang</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Uang Jaminan Lelang</td>
                            <td>345.000.000</td>
                            <td>245.000.000</td>
                            <td>100.000.000</td>
                        </tr>
                        <tr>
                            <td>Pelunasan Lelang</td>
                            <td>123.000.000</td>
                            <td>53.000.000</td>
                            <td>70.000.000</td>
                        </tr>
                        <tr>
                            <td>PPh</td>
                            <td>25.688.000</td>
                            <td>34.675.000</td>
                            <td>3.000.000</td>
                        </tr>
                        <tr>
                            <td>PNBP</td>
                            <td>34.454.000</td>
                            <td>780.568</td>
                            <td>433.333</td>
                        </tr>
                        <tr>
                            <td>Wanprestasi</td>
                            <td>8.454.000</td>
                            <td>46.568</td>
                            <td>965.333</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <h5 class="card-title mt-4">Pembukuan Piutang</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Angsuran Hutang</td>
                            <td>11.000.000</td>
                            <td>3.000.000</td>
                            <td>4.000.000</td>
                        </tr>
                        <tr>
                            <td>Pelunasan Hutang</td>
                            <td>13.000.000</td>
                            <td>4.000.000</td>
                            <td>23.000.000</td>
                        </tr>
                        <tr>
                            <td>PNBP</td>
                            <td>35.454.000</td>
                            <td>1.780.568</td>
                            <td>34.433.333</td>
                        </tr>
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
                    url: "{{ route('chart') }}",
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
                                    label: 'Data Transaksi Per Bulan',
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
                    url: "{{ route('chart') }}",
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
                                labels: labels,
                                datasets: [{
                                    label: 'Data Transaksi Per Bulan',
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

            });
        });
    </script>
@endpush
