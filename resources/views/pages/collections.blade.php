@extends('theme.layout',
    [
        'meta_title' => 'Armory',
        'body' => 'collections'
    ])

@section('content')

    @include('theme.partials.menu')

    <collections :petslots="petSlots" :pets="pets" :mounts="mounts"></collections>

@endsection

@section('scripts')
    <script>
        var character = Object.values({!! json_encode($character) !!});
        var background = {!! json_encode($background) !!};
        var backgroundimage = {!! json_encode($backgroundimage) !!};
        var petSlots = Object.values({!! json_encode($petslots) !!});
        var pets = Object.values({!! json_encode($pets) !!});
        var mounts = Object.values({!! json_encode($mounts) !!});
    </script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/collections.js') }}"></script>
@endsection