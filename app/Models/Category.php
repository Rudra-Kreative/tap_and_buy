<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_id');
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class,'created_id');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
