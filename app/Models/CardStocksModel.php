<?php

namespace App\Models;

use CodeIgniter\Model;

class CardStocksModel extends Model
{
    protected $table = "card_stocks";
    protected $primaryKey = "id";
    protected $allowedFields = ['id','date','information','id_item','stock_in','stock_out','saldo'];
}
