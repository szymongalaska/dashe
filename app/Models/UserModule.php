<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function position(): Attribute
{
        return Attribute::make(
            set: function($value, $attributes) { 
                $val = $this->where('user_id', $attributes['user_id'])->max('position');
                return $val === null ? 0 : $val + 1;
            }
        );
    }
}
