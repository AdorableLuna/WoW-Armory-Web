<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServersController extends Controller
{
    public function index($region)
    {
        $realms = file_get_contents('https://realmpop.com/' . $region . '.json');
        $realms  = json_decode($realms, true);
        $realms = $realms['realms'];
        foreach ($realms as $item => $value) {
            if (strpos($value['name'], 'Internal') !== false)
            {
                unset($realms[$item]);
            }
        }

        return view('pages.servers', compact('realms'));
    }
}
