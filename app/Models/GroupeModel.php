<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupeModel extends Model
{
    protected $table            = 'groupe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['nom'];

    protected $useTimestamps = false;
}
