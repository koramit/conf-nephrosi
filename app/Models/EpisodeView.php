<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpisodeView extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $casts = ['vied_at' => 'datetime'];

    // episode view belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // episode view belongs to an episode
    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
