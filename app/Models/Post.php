<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;



class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use HasTags;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'img_name',

    ];
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::bootSoftDeletes();
    // }
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
