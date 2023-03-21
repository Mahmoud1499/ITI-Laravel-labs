<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;



class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'img_name',

    ];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
