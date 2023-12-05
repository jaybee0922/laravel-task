<?php

namespace App\Imports;

use App\Models\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class LogsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Log([
            'name' => $row[0],
            'date' => $row[1],
            'time' => $row[2],
        ]);
    }
}
