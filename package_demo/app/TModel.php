<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $table = 't';
}
