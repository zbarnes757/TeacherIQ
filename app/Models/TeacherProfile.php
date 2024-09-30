<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TeacherProfile extends Model
{
    use HasFactory;

    public int $user_id;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'bio',
        'can_be_remote',
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

    protected function casts(): array
    {
        return [
            'can_be_remote' => 'boolean',

        ];
    }
}
