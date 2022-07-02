<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'notifiable', 'photo','data','read_at','user_id','notifiable_type','notifiable_id',
    
        
    
        
    ];

    public function add_by()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

}


 
