<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    public function user() : BelongsTo {
        return $this->belongsTo(User::class,'assigned_to');
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }
    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_to',
        'department_id',
        'category_id',
        'priority',
    ];
}
