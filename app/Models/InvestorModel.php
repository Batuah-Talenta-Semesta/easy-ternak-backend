<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorModel extends Model
{
    use HasFactory;

    protected $table = 'investor';
    protected $primaryKey = 'id_investor';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_investor',
        'id_user',
        'name',
        'address',
        'ktp',
        'payment_name',
        'payment_account',
        'payment_number',
        'telephone',
    ];

    public $timestamps = false;
}
