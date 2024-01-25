@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="mb-4">Selamat Datang di APIK</h1>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium iste maxime adipisci quos doloribus reiciendis
        hic, eius earum expedita eos repellat eveniet! Eius vero, exercitationem quibusdam porro id optio temporibus!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At blanditiis quod quos iste, exercitationem totam? Magni
        minus libero enim exercitationem excepturi, possimus necessitatibus aperiam illum laborum ullam, dolores, saepe
        repellendus.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, odit, illo accusamus rerum corporis doloribus
        officia consectetur debitis tempore at nostrum fugiat velit cupiditate magni architecto distinctio eos omnis
        voluptates.</p>
    <div class="row">
        <div class="col-lg-3">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ auth()->user()->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ auth()->user()->nip }}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td>{{ auth()->user()->role }}</td>
                    </tr>
                    <tr>
                        <td>Kdsatker</td>
                        <td>:</td>
                        <td>{{ auth()->user()->kode_satker }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
