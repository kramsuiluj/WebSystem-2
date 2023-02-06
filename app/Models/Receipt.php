<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table='receipts';
    protected $primaryKey = 'id';
    public $timestamps= true;

    protected $fillable = [
        'recipient',
        'prod_name',
        'prod_qty',
        'receiptfor',
        'paid_fee',
        'total_fee',
        'proof',
        'date',
        'invoiceNo'
    ];
}


// class tixMdl extends Model
// {
//     use HasFactory;

//     protected $table='tixticket';
//     protected $primaryKey = 'id';
//     public $timestamps= true;

//     protected $fillable = [
//         'id',
//         'ticket',
//         'mem_id',
//         'usergroup',
//         'status',
//         'created_at',
//         'updated_at'
//     ];
// }