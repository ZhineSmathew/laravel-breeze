<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'product_name',
        'description',
        'category',
        'quantity',
    ];
    // A product can belong to many carts, and a cart can have many products.
    public function cart() :BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity')->withTimestamps();
    }

    public static function getEnumValues($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM " . (new static)->getTable() . " WHERE Field = '$column'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $enum = [];
        if (!empty($matches[1])) {
            $enum = array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $matches[1]));
        }

        return $enum;
    }

}
