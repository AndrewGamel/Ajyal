<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'first_name','last_name','birthday','gender','image','city','street_address','state','postal_code','country','locale'];
}
/*

            $table->enum(, ['male', 'female'])->nullable();
            $table->string()->nullable();
            $table->string()->nullable();
            $table->string()->nullable();


 */