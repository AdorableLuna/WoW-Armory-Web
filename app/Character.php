<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public $character;
    public $title;
    public $class;
    public $spec;
    public $talents;
    public $guild;
    public $race;
    public $backgroundimage;

    public function create($request)
    {
        $character = file_get_contents('https://' . $request->route('region') . '.api.battle.net/wow/character/' . $request->route('server') . '/' . $request->route('charactername') . '?fields=items&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $titles = file_get_contents('https://' . $request->route('region')  . '.api.battle.net/wow/character/' . $request->route('server') . '/' . $request->route('charactername') . '?fields=titles&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $talents = file_get_contents('https://' . $request->route('region') . '.api.battle.net/wow/character/' . $request->route('server') . '/' . $request->route('charactername') . '?fields=talents&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $guild = file_get_contents('https://' . $request->route('region') . '.api.battle.net/wow/character/' . $request->route('server') . '/' . $request->route('charactername') . '?fields=guild&locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan');
        $character  = json_decode($character, true);
        $titles  = json_decode($titles, true);
        $talents = json_decode($talents, true);
        $guild  = json_decode($guild, true);

        $this->setCharacter($character);
        $this->setTitle($titles);
        $this->setClass($character);
        $this->setSpec($talents);
        $this->setTalents($talents);
        $this->setGuild($guild);
        $this->setRace($character);
    }

    private function setCharacter($character)
    {
        $this->character = $character;
    }

    private function setTitle($titles)
    {
        foreach ($titles['titles'] as $title)
        {
            if (isset($title['selected']) && $title['selected'] == true)
            {
                if (strpos($title['name'], '%s, ') !== false)
                {
                    $this->title = str_replace('%s, ', '', $title['name']);
                }
                else if (strpos($title['name'], '%s ') !== false)
                {
                    $this->title = str_replace('%s ', '', $title['name']);
                }
                else if (strpos($title['name'], ' %s') !== false)
                {
                    $this->title = str_replace(' %s', '', $title['name']);
                }
                break;
            }
        }
    }

    private function setClass($character)
    {
        switch($character['class']) {
            case 1:
                $this->class = 'Warrior';
                $this->background = '#1a0407';
                $this->backgroundimage = '8JVSQSZA5D7L1479495661881';
                break;
            case 2:
                $this->class = 'Paladin';
                $this->background = '#13040a';
                $this->backgroundimage = 'B21L27N48S321479495656678';
                break;
            case 3:
                $this->class = 'Hunter';
                $this->background = '#0f091b';
                $this->backgroundimage = 'SCK1OM3E087W1479495654573';
                break;
            case 4:
                $this->class = 'Rogue';
                $this->background = '#160720';
                $this->backgroundimage = 'G1ZLRJJYKH3V1479495658811';
                break;
            case 5:
                $this->class = 'Priest';
                $this->background = '#15060e';
                $this->backgroundimage = '431YIGDRJ46T1479495657850';
                break;
            case 6:
                $this->class = 'Death Knight';
                $this->background = '#080812';
                $this->backgroundimage = 'W3VSUPP3C5721479495651600';
                break;
            case 7:
                $this->class = 'Shaman';
                $this->background = '#050414';
                $this->backgroundimage = '1G5MTEUI836V1479495659273';
                break;
            case 8:
                $this->class = 'Mage';
                $this->background = '#110617';
                $this->backgroundimage = 'YPLHZ8Z5M04Z1479495655059';
                break;
            case 9:
                $this->class = 'Warlock';
                $this->background = '#080516';
                $this->backgroundimage = 'A3DULGMGJQMA1479495659915';
                break;
            case 10:
                $this->class = 'Monk';
                $this->background = '#040b17';
                $this->backgroundimage = 'MJUH2QR2H7RX1479495655630';
                break;
            case 11:
                $this->class = 'Druid';
                $this->background = '#04100a';
                $this->backgroundimage = '091UJWAZBTCO1479495653374';
                break;
            case 12:
                $this->class = 'Demon Hunter';
                $this->background = '#000900';
                $this->backgroundimage = '80QHZ8M9Y2J81479495652985';
                break;
        }
    }

    private function setSpec($talents)
    {
        foreach ($talents['talents'] as $property)
        {
            if (isset($property['selected']) && $property['selected'] == true)
            {
                $this->spec = $property['spec']['name'];
            }
        }
    }

    private function setTalents($talents)
    {
        $this->talents = $talents;
    }

    private function setGuild($guild)
    {
        $this->guild = $guild;
    }

    private function setRace($character)
    {
        switch($character['race']) {
            case 1:
                $this->race = 'Human';
                break;
            case 2:
                $this->race = 'Orc';
                break;
            case 3:
                $this->race = 'Dwarf';
                break;
            case 4:
                $this->race = 'Night Elf';
                break;
            case 5:
                $this->race = 'Undead';
                break;
            case 6:
                $this->race = 'Tauren';
                break;
            case 7:
                $this->race = 'Gnome';
                break;
            case 8:
                $this->race = 'Troll';
                break;
            case 9:
                $this->race = 'Goblin';
                break;
            case 10:
                $this->race = 'Blood Elf';
                break;
            case 11:
                $this->race = 'Draenei';
                break;
            case 22:
                $this->race = 'Worgen';
                break;
            case 24:
                $this->race = 'Pandaren';
                break;
            case 25:
                $this->race = 'Pandaren';
                break;
            case 26:
                $this->race = 'Pandaren';
                break;
        }
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
}
