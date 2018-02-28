<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public $character;
    public $title;
    public $class;
    public $spec;
    public $talents;
    public $guild;
    public $race;
    public $background;
    public $backgroundimage;

    public function __construct(Request $request)
    {
        $this->middleware('sessions');

        $character = new Character;
        $character->create($request);

        $this->character = $character->getProperty('character');
        $this->title = $character->getProperty('title');
        $this->class = $character->getProperty('class');
        $this->spec = $character->getProperty('spec');
        $this->talents = $character->getProperty('talents');
        $this->guild = $character->getProperty('guild');
        $this->race = $character->getProperty('race');
        $this->background = $character->getProperty('background');
        $this->backgroundimage = $character->getProperty('backgroundimage');
    }

    public function index($region, $realm, $charactername)
    {
        $stats = file_get_contents('https://' . $region . '.api.battle.net/wow/character/' . $realm . '/' . $charactername . '?fields=stats&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $stats  = json_decode($stats, true);

        $character = $this->character;
        $title = $this->title;
        $class = $this->class;
        $spec = $this->spec;
        $talents = $this->talents;
        $guild = $this->guild;
        $race = $this->race;
        $background = $this->background;

        return view('pages.character', compact('character', 'background', 'title', 'guild', 'stats', 'class', 'race', 'spec', 'talents'));
    }

    public function collection($region, $realm, $charactername)
    {
        $petslots = file_get_contents('https://' . $region . '.api.battle.net/wow/character/' . $realm . '/' . $charactername . '?fields=petSlots&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $pets = file_get_contents('https://' . $region . '.api.battle.net/wow/character/' . $realm . '/' . $charactername . '?fields=pets&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $mounts = file_get_contents('https://' . $region . '.api.battle.net/wow/character/' . $realm . '/' . $charactername . '?fields=mounts&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $petslots  = json_decode($petslots, true);
        $pets  = json_decode($pets, true);
        $mounts  = json_decode($mounts, true);

        foreach ($petslots['petSlots'] as $index => $petslot)
        {
            foreach ($pets['pets']['collected'] as $key => $pet)
            {
                if ($petslot['battlePetGuid'] == $pet['battlePetGuid'])
                {
                    $petslot['name'] = $pet['name'];
                    $petslot['creatureId'] = $pet['creatureId'];
                    $petslot['icon'] = $pet['icon'];
                    $petslot['quality'] = $this->getQuality($pet['qualityId']);
                    $petslot['stats'] = $pet['stats'];
                    $petslot['isFavorite'] = $pet['isFavorite'];
                    $petslots['petSlots'][$index] = $petslot;
                }

                $pet['quality'] = $this->getQuality($pet['qualityId']);
                $pets['pets']['collected'][$key] = $pet;
            }
        }

        $petslots = $petslots['petSlots'];
        $pets = $pets['pets'];

        foreach ($mounts['mounts']['collected'] as $index => $mount)
        {
            $mount['quality'] = $this->getQuality($mount['qualityId']);
            $mounts['mounts']['collected'][$index] = $mount;
        }

        $mounts = $mounts['mounts'];

        $character = $this->character;
        $title = $this->title;
        $class = $this->class;
        $spec = $this->spec;
        $guild = $this->guild;
        $race = $this->race;
        $background = $this->background;
        $backgroundimage = $this->backgroundimage;

        return view('pages.collections', compact('character', 'background', 'backgroundimage', 'title', 'class', 'spec', 'guild', 'race', 'petslots', 'pets', 'mounts'));
    }

    private function getQuality($id)
    {
        switch ($id) {
            case 0:
                return '#9d9d9d';
            case 1:
                return '#fff';
            case 2:
                return '#1eff00';
            case 3:
                return '#0081ff';
            case 4:
                return '#c600ff';
            case 5:
                return '#ff8000';
            case 6:
                return '#e5cc80';
            case 7:
                return '#0cf';
        }
    }
}
