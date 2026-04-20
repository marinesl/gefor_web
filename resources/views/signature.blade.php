@extends('layouts.base')

@section('title')
    Signature
@endsection

@push('scripts')
    @vite('resources/js/signature.js')
@endpush

@section('content')
    <h1>Page signature</h1>

    <p>Cours de Maths - le 21/04/2026 à 9h</p>

    <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>

    <div>
        <button id="save">Enregistrer</button>
        <button id="clear">Effacer</button>
    </div>
@endsection
