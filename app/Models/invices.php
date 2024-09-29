<?php

namespace App\Models;

use App\Models\sections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invices extends Model
{
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(sections::class);
    }
}
