<?php

namespace App\Imports;

use App\Models\Graph;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GraphImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Graph([
            'from_user' => $row['from_user'],
            'from_user_id' => $row['from_user_id'],
            'text' => $row['text'],
            'id_text' => $row['id'],
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
