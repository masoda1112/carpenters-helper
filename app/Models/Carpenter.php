<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Carpenter extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->belongsToMany(Message::class,'message_carpenter','carpenter_id','message_id');
    }
}
