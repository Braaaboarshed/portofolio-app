<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
protected $fillable = ['type' , 'value','link'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
