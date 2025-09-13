<?php

namespace App\Utils;
use Illuminate\Support\Str;
class Util
{

    public function generateReference()
    {
        $prefix = 'ST';
        $year = now()->format('Y');
        $ref_no = strtoupper($prefix.$year.'-'.Str::upper(Str::random(6)));
          
        return $ref_no;
    }
}