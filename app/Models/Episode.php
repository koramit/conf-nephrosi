<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $guarded = [];

    // episode has many views
    public function views()
    {
        return $this->hasMany(EpisodeView::class);
    }
}
