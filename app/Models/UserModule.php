<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModule extends Model
{
       protected $fillable = [
        'user_id',
        'module_id',
        'config',
        'enabled',
        'position',
    ];

    protected $casts = [
        'config' => 'array',
        'enabled' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function name(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Module::class);
    }
}
