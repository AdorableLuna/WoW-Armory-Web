@extends('theme.layout',
    [
        'meta_title' => 'Armory',
        'body' => 'characters'
    ])

@section('content')

    @include('theme.partials.menu')
    <character :character="character" :background="background" :spec="spec" :talents="talents"></character>

@endsection

@section('scripts')
    <script>
        var character = Object.values({!! json_encode($character) !!});
        var background = {!! json_encode($background) !!};
        var backgroundimage = null;
        var stats = Object.values({!! json_encode($stats) !!});
        var spec = {!! json_encode($spec) !!};
        var talents = Object.values({!! json_encode($talents) !!});
        var realms = null;
    </script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/character.js') }}"></script>
@endsection