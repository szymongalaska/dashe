<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function userModules(): HasMany
    {
        return $this->HasMany(UserModule::class);
    }

    public static function icons(): array
    {   
        return Module::pluck('icon', 'name')->toArray();
    }
}
