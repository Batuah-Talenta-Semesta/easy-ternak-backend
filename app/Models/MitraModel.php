<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mitra';

    // Primary key dari tabel
    protected $primaryKey = 'id_mitra';

    // Tipe primary key (bigint unsigned)
    protected $keyType = 'unsignedBigInteger';

    // Menentukan apakah primary key menggunakan auto increment
    public $incrementing = true;

    // Menggunakan timestamps
    public $timestamps = true;

    // Fields yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_user',
        'name',
        'telephone',
        'address',
        'ktp',
        'payment_name',
        'payment_account',
        'payment_number',
    ];

    // Fields yang harus disembunyikan saat serialisasi
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


}
