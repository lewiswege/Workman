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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function installations()
    {
        return $this->hasMany(Installations::class);
    }
}
