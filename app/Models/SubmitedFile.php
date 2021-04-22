<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitedFile extends Model
{
    use HasFactory;
    protected $table= "submitted_files";
    protected $guarded = [];
}
