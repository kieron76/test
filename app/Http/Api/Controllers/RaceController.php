<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Race;

class RaceController extends Controller
{
    public function get(Race $race) 
    {
        return response()->json($race);
    }

    public function getRaces(Race $race) 
    {
        return response()->json(
            Race::get()
                ->toArray()
        );
    }

    public function post() 
    {
        $data = request()->all();
        $race = new Race();
        $race->fill($data);
        $race->save();
        return response('OK');
    }

    public function put(Race $race) 
    {
        $data = request()->all();
        $race->fill($data);
        $race->save();
        return response('OK');
    }

    public function delete(Race $race) 
    {
        $race->delete();
        return response('OK');
    }
}