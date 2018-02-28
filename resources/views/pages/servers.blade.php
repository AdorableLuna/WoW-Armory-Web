@extends('theme.layout',
    [
        'meta_title' => 'Armory',
        'body' => 'server'
    ])

@section('content')

    <realms :realms="realms"></realms>

@endsection

@section('scripts')
    <script>
        var character = null;
        var stats = null;
        var spec = null;
        var talents = null;
        var realms = Object.values({!! json_encode($realms) !!});
    </script>
    <script src="{{ URL::asset('js/bundle.js') }}"></script>
@endsection