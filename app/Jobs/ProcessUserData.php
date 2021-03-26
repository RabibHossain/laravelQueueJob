<?php

namespace App\Jobs;

use App\Models\FacebookUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUserData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;

    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function handle()
    {
        foreach ($this->data as $value) {
            $fbUsers = array_combine($this->header, $value);
            FacebookUser::create($fbUsers);
        }
    }

        /*    */
//        $path = resource_path('temp');
//        $files = glob("$path/*.csv");
//        $header = [];
//        foreach ($files as $key => $file) {
//            $data = array_map('str_getcsv', file($file));
//            if ($key === 0) {
//                $header = $data[0];
//                unset($data[0]);
//            }
//            foreach ($data as $value) {
//                $fbUsers = array_combine($header, $value);
//                FacebookUsers::create($fbUsers);
//            }
//
//            unlink($file);
//        }

    }
