<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'info',
    ];
    public function user (){
        return $this->belongsTo(User::class);
    }
    public function htmltag()
    {
        return $this->belongsTo(HtmlTag::class);
    }
}
