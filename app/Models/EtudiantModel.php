<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table            = 'etudiant';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['num_matiere', 'nom', 'prenom', 'matricule', 'note', 'result'];

    protected $useTimestamps = false;
}
