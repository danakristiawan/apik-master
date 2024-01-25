@extends('layouts.app')

@section('title', 'Referensi')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>item</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>User</td>
                        <td><a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Menu</td>
                        <td><a href="{{ route('ref-menu.index') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bank</td>
                        <td><a href="{{ route('ref-bank.index') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Satker</td>
                        <td><a href="{{ route('ref-satker.index') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kode Transaksi</td>
                        <td><a href="{{ route('ref-kode-transaksi.index') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Kode Sub Transaksi</td>
                        <td><a href="{{ route('ref-kode-sub-transaksi.index') }}" class="btn btn-sm btn-primary">pilih</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
