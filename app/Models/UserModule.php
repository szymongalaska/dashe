<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModule extends Model
{
    use HasFactory;
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

    public function module(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Module::class);
    }

    public function widgets(): HasMany
    {
        return $this->HasMany(Widget::class);
    }
}
