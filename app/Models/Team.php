<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'identity',
        'leader',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
        ];
    }
}
