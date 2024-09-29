<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class TeacherProfile extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'bio'
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
