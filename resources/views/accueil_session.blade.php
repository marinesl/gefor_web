@extends('layouts.base')

@section('title')
    Accueil - Sessions
@endsection

@section('content')
    <h1>Page accueil - session</h1>

    <p>Bonjour, {{ Auth::user()->name }}</p>

    <p>
        <a href="{{ route('logout') }}"
           class="btn btn-outline-danger">
            Se déconnecter
        </a>
    </p>

    <ul>
        @foreach ($cours as $c)
            <li>
                Cours de {{ $c->matiere }}
                - le {{ \Carbon\Carbon::parse($c->date)->format('d/m/Y') }}
                de {{ \Carbon\Carbon::parse($c->heure_debut)->format('H\hi') }} à {{ \Carbon\Carbon::parse($c->heure_fin)->format('H\hi') }} dans la salle {{ $c->salle }}
                <a href="{{ route('signature', $c->id) }}">Signer</a>
            </li>
        @endforeach
    </ul>
@endsection
