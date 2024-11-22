<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    protected $fillable = [
        'categories_name',
        'description',
    ];

    public function ticket() {
        return $this->hasMany(ticket::class);
    }

}
