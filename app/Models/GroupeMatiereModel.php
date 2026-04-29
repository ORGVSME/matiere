<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupeMatiereModel extends Model
{
    protected $table            = 'groupe_matiere';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_groupe', 'id_matiere'];

    protected $useTimestamps = false;
}
