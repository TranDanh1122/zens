<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Joke extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'content',
        'up',
        'down',
    ];
    protected $table = 'jokes';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeRandomJokeWhereNotIn($query, $array)
    {
        return $query->whereNotIn('id', $array)->orderByRaw('RAND()');
    }
}
