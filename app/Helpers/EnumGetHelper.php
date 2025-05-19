<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class EnumGetHelper
{
    public static function getEnumValues(string $table, string $column): array
    {
        
        $type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'")[0]->Type;
        
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        return array_map(fn($val) => trim($val, "'"), explode(',', $matches[1]));
    }
}
