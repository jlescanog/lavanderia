@extends('template.template')

@section('tittle', 'Ordenes')

@section('navbar')
    <div id="navbar"></div>
@endsection

@section('content')
    <main id='app'>
        <orden-form />
    </main>
@endsection
