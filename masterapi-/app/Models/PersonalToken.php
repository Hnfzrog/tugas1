<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsTo;

class PersonalToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'token',
        'abilities',
        'lastUsedAt'
    ];
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "userId", "id");
    }
}
