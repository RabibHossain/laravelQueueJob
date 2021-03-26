<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessUserData;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        if (request()->has('csvFile')) {
            $data = file(request()->csvFile);

            $chunks = array_chunk($data, 1000);
//dd($chunks);
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                $path = resource_path('temp');
                file_put_contents($path . $name, $chunk);
            }

            return 'Done';
        }

        return 'please upload file';
    }

    public function store()
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");
        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            ProcessUserData::dispatch($data, $header);
            unlink($file);
        }

        return 'Stored';
    }

}
