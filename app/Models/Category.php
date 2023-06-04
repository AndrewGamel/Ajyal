<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable =[ 'parent_id','name', 'description', 'image', 'status', 'slug'];
    public static function rules($id  = 0)
    {
      return [
            'name'=> [
                'required','string','min:3','max:255',
                Rule::unique('categories','name')->ignore($id),

                new Filter(),'filter:Androw,Gamel,isis',
            ],
            'parent_id'=> 'nullable|integer|exists:categories,id',
            'image'=> 'mimes:png,jpg|max:1048576|dimensions:min_width=100,max_width= 1000',
            'status' => 'required|in:active,archived'
      ];
    }
}