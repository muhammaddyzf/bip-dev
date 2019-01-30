<?php

namespace App\Imports;

use App\Ikm;
use Maatwebsite\Excel\Concerns\ToModel;

class IkmImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ikm([
            'IKM_NAMA'     => $row[1],
            'IKM_PEMILIKI' => $row[2]
        ]);
    }
}
