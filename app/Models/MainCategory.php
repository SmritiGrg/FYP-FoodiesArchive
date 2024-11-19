<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function sub_categories(): void
    {
        $this->hasMany(SubCategory::class, 'main_cat_id', 'id');
    }
}
