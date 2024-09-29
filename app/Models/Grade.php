<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grade extends Model
{
    use HasFactory;

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(TeacherProfile::class);
    }
}
