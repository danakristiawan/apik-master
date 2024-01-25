@extends('layouts.app')

@section('title', 'Utilitas')

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
                        <td>Tarik Data Lelang BNI</td>
                        <td><a href="{{ route('bni.lelang') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Tarik Data Piutang BNI</td>
                        <td><a href="{{ route('bni.piutang') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tarik Data Lelang Bank Mandiri</td>
                        <td><a href="{{ route('mandiri.lelang') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Tarik Data Piutang Bank Mandiri</td>
                        <td><a href="{{ route('mandiri.piutang') }}" class="btn btn-sm btn-primary">pilih</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
