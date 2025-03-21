<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, HasUuids;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'status'];
    protected $dates = ['deleted_at'];

    protected $keyType = 'string';
    public $incrementing = false;
}
