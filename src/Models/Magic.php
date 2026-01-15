<?php

namespace Brunoabpinto\Magic\Models;

use Illuminate\Database\Eloquent\Model;

class Magic extends Model
{
    protected $fillable = ['key', 'value'];

    public function getTable()
    {
        return config('magic.table_name', '_magic');
    }
}
