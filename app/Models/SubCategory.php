<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'main_cat_id'];

    public function main_categories(): void
    {
        $this->belongsTo(MainCategory::class, 'main_cat_id', 'id');
    }
}