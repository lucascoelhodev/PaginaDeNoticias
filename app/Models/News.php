<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillabe = ['title', 'content','image'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
