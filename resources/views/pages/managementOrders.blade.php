@extends('template.template')

@section('tittle', 'Gestion Ordenes')

@section('navbar')
    <div id="navbar"></div>
@endsection

@section('content')
    <main id='app'>
        <management-orders />
    </main>
@endsection
