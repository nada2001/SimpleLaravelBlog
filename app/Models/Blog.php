<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [ 'title', 'tags','content','picture','user_id'];
 
    //relationship
    public function author()
    {
    return $this->belongsTo(User::class, 'user_id','id');
    }
}
