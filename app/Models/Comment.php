<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'photo','user_id','post_id'
    ];
    public function user_id()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function post_id()
    {
        return $this->hasOne('App\Models\Post','id','post_id');
    }
}
