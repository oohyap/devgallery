<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['title', 'author_id', 'slug', 'body', 'hosting', 'image'];
    
    // Eager Loading Laravel
    protected $with = ['author'];
    public function author():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function images()
    {
    return $this->hasMany(ProjectImage::class);
    }
    public function firstImage()
    {
    return $this->hasOne(ProjectImage::class)->oldestOfMany();
    }

    public function getRouteKeyName(): string
    {
    return 'slug';
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
    $filters['search'] ?? false, 
  fn ($query, $search)=>
            $query->where('title', 'like', '%' . $search . '%')
        );
        $query->when(
    $filters['author'] ?? false, 
  fn ($query, $author)=>
            $query->whereHas('author', fn($query)=> $query->where('username', $author))
        );
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
