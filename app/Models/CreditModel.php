<?php

namespace App\Models;

use CodeIgniter\Model;

class CreditModel extends Model
{
    protected $table            = 'credit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_groupe_matiere', 'credits'];

    protected $useTimestamps = false;
}
