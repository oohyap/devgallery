<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['content', 'author_id', 'project_id'];



    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function author():BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');

    }
    
}
