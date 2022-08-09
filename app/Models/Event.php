<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'description', 'city', 'private', 'image', 'items', 'date'];

    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
    ];

    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->BelongsToMany(User::class);
    }
}
