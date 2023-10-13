<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Kasir extends Model implements Authenticatable
{
    use AuthenticatableTrait, HasFactory;    
    protected $table = 'kasirs';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
