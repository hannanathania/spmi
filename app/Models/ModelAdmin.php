<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAdmin extends Model
{
    use HasFactory;
    protected $table = 'public.admins';
    protected $fillable = ['username', 'password'];
    protected static function booted()
    {
        static::updated(function ($admin) {
            // Call the method to send the warning
            app(WarningService::class)->sendWarning($admin);
        });
    }
}
