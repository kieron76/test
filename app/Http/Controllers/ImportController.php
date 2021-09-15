<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Classes\RacingCardParser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;

class ImportController extends Controller
{
    public function post()
    {
        try {
            $contents = request()->getContent();

            $this->checkContents($contents);

            $fileName = Carbon::now()->format('Ymd-His') . '.xml';

            \Storage::disk('local')->put('press_association/' . $fileName, $contents);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        // pa probably isn't going to care either way
        return response('[OK]',200);
    }

    protected function checkContents($contents) 
    {
        if (substr($contents,0, strpos($contents, "\n")) != '<?xml version="1.0" encoding="UTF-8" standalone="no"?>') {
            throw new \Exception("Unrecognised File Format");
        }

        return true;
    }

}