<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Horse;

class HorseController extends Controller
{
    public function get(Horse $horse) 
    {
        return response()->json($horse);
    }

    public function getHorses(Horse $horse) 
    {
        return response()->json(
            Horse::get()
                ->toArray()
        );
    }

    public function post() 
    {
        $data = request()->all();
        $horse = new Horse();
        $horse->fill($data);
        $horse->save();
        return response('OK');
    }

    public function put(Horse $horse) 
    {
        $data = request()->all();
        $horse->fill($data);
        $horse->save();
        return response('OK');
    }

    public function delete(Horse $horse) 
    {
        $horse->delete();
        return response('OK');
    }
}