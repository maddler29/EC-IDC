<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HasFactory;

class Inquiry extends Model
{

    protected $fillable = [
        'title',
        'email',
        'body',
    ];
}
