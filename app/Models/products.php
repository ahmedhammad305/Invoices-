<?php

namespace App\Models;
use App\Models\products;
use App\Models\sections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class products extends Model
{
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(sections::class);
    }
}
