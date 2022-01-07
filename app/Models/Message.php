<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Sentence;
use App\Models\Carpenter;

class Message extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function carpenters()
    {
        return $this->belongsToMany(Carpenter::class,'message_carpenter','message_id','carpenter_id');
    }
}
