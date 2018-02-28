<div class="characterheader-container">
    <div class="characterheader-character">
        <img src="{{ ($character['faction'] == '0') ? asset('img/character/faction/alliance.png') : asset('img/character/faction/horde.png') }}">
        <div class="characterheader-nameArea">
            <div class="characterheader-nameTitle">
                <a class="name {{ strtolower($class) }}" href="{{ strtolower($character['name']) }}">{{ $character['name'] }}</a>
                <span class="title">{{ $title }}</span>
            </div>
        </div>
    </div>
    <div class="characterheader-info">
        <div class="characterheader-stats">
            <a href="">
                <svg viewBox="0 0 64 64">
                    <use xlink:href="/img/character/stats/achievement-shield.svg#achievement-shield" />
                </svg>
                <span>{{ $character['achievementPoints'] }}</span>
            </a>
            <a href="">
                <svg viewBox="0 0 64 64">
                    <use xlink:href="/img/character/stats/swords.svg#swords" />
                </svg>
                <span>{{ $character['items']['averageItemLevelEquipped'] }} ilvl</span>
            </a>
        </div>
        <div class="characterheader-details">
            <span>{{ $character['level'] }} {{ $race }} {{ $spec }} {{ $class }} <a class="guild" href="">❮{{ $guild['guild']['name'] }}❯</a> {{ $character['realm'] }}</span>
        </div>
    </div>
</div>

<div class="navigation-container">
    <div class="navigation">
        <a {{ ((Route::currentRouteName() == 'character') ? 'class=active' : '') }} href="{{ route('character', ['region' => Session::get('region'), 'server' => Session::get('server'), 'charactername' => Session::get('charactername')]) }}">Character</a>
        <a href="">Achievement</a>
        <a {{ ((Route::currentRouteName() == 'collections') ? 'class=active' : '') }} href="{{ route('collections', ['region' => Session::get('region'), 'server' => Session::get('server'), 'charactername' => Session::get('charactername')]) }}">Collections</a>
        <a href="">Raid Progression</a>
        <a href="">Player vs Player</a>
        <a href="">Reputation</a>
    </div>
</div>