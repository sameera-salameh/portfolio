<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'proficiency_level',
    ];
    public function user (){
        return $this->belongsTo(User::class);
    }
    public function htmltag()
    {
        return $this->belongsTo(HtmlTag::class);
    }
}
