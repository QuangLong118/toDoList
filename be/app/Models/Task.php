<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'deadline',
        'completed',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        // Tự động gán UUID khi tạo mới
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
