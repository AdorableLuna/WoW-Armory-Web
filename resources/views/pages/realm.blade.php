@extends('theme.layout',
    [
        'meta_title' => 'Armory',
        'body' => 'realms'
    ])

@section('content')

    <div class="realm-container">

        <div class="realm">
            <h1>Choose a realm</h1>

            <figure class="realm-eu">
                <a href="{{ route('servers', ['realm' => 'eu']) }}">
                    <img src="{{ asset('img/realms/eu.svg') }}" alt="eu">
                    <figcaption>EU realms</figcaption>
                </a>
            </figure>
            <figure class="realm-us">
                <a href="{{ route('servers', ['realm' => 'us']) }}">
                    <img src="{{ asset('img/realms/us.svg') }}" alt="us">
                    <figcaption>US realms</figcaption>
                </a>
            </figure>
        </div>

    </div>

@endsection