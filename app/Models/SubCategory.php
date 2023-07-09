<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'subcategory_id');
    }


}