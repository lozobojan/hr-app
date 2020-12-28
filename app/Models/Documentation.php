<?php

namespace App\Models;

use App\Traits\FileHandling;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Documentation extends Model
{
    use HasFactory, \RecursiveRelationships\Traits\HasRecursiveRelationships, FileHandling;
    
    protected $table = 'documentations';

    public $primaryKey = "id";
    protected $guarded = [];

}
