<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'department_id',
        'category_id',
        'user_id',
        'priority',
        'assigned_to',
        'status',
        'start_time',
        'end_time',
        'followers',
    ];
    
    public function assignedTo() : BelongsTo {
        return $this->belongsTo(User::class,'assigned_to');
    }
    public function fileowner() : BelongsTo {
        return $this->belongsTo(User::class,'followers');
    }
    public function user() : BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function category() {
        return $this->belongsTo(Categori::class,'category_id');
    }
    
    
}
