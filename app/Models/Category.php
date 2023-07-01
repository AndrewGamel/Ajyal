<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['parent_id', 'name', 'description', 'image', 'status', 'slug'];

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        // if ($filters['name'] ?? false) {
        //     $builder->where('name','LIKE',"%{$filters['name']}%");
        //    }
        if ($filters['status'] ?? false) {
            $builder->where('categories.status', '=', $filters['status']);
        }
    }

    public static function rules($id  = 0)
    {
        return [
            'name' => [
                'required', 'string', 'min:3', 'max:255',
                Rule::unique('categories', 'name')->ignore($id),

                new Filter(), 'filter:Androw,Gamel,isis',
            ],
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'mimes:png,jpg|max:1048576|dimensions:min_width=100,max_width= 1000',
            'status' => 'required|in:active,archived'
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
