<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    protected $primaryKey = 'idPayer';

    protected $table = 'payers';

    protected $fillable = [
        'idPedido','PayerID','statusTransaction','pendingReason','reasonCode','amountPay','browser','version_browser','deviceFamily','deviceModel','platform'
    ];

}
