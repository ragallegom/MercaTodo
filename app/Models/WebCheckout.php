<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebCheckout extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'document',
        'document_type',
        'company',
        'email',
        'mobile',
        'address'
    ];
}
