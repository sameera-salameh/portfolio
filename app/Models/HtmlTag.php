<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtmlTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
    ];
    public function aboutMe()
    {
        return $this->hasOne(AboutMe::class);
    }
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
    public function education()
    {
        return $this->hasOne(Education::class);
    }
    public function project()
    {
        return $this->hasOne(Project::class);
    }
    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function skill()
    {
        return $this->hasOne(Skill::class);
    }
}
