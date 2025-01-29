<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function userModules()
    {
        return $this->HasMany(UserModule::class);
    }
}
