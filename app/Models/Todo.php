<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'is_done',
        'due_date',
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'due_date' => 'datetime',  // ← Carbon に変換される
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
