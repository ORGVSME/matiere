<?php

namespace App\Models;

use CodeIgniter\Model;

class MatiereModel extends Model
{
    protected $table            = 'matiere';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['num_matiere', 'id_option', 'id_parcours', 'nom'];

    protected $useTimestamps = false;
}
