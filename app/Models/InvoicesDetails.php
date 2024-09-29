<?php

namespace App\Models;

use App\Models\invices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoicesDetails extends Model
{
    protected $guarded = [];
    
    public function invices()
    {
        return $this->belongsTo(invices::class);
    }
}
