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

    <form id="signature-form" method="POST" action="{{ route('signatures.post') }}">
        @csrf

        {{-- cours id from query: /signature?cours=186 --}}
        <input type="hidden" id="cours_id" name="cours_id" value="{{ request()->query('cours') }}">

        {{-- base64 signature will be set by JS before submit --}}
        <input type="hidden" id="signature_input" name="signature">

        <button type="button" id="save">Enregistrer</button>
        <button type="button" id="clear">Effacer</button>
    </form>
@endsection
