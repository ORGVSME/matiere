<?php

namespace App\Controllers;

use App\Models\User;

class Users extends BaseController
{
    protected $userModel;
    protected $perPage = 6;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Affiche la liste des utilisateurs
     */
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $role = $this->request->getGet('role') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $department = $this->request->getGet('department') ?? '';
        $page = (int)($this->request->getGet('page') ?? 1);

        $query = $this->userModel;

        // Filtrer par recherche
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('matricule', $search)
                ->groupEnd();
        }

        // Filtrer par rôle
        if (!empty($role)) {
            $query = $query->where('role', $role);
        }

        // Filtrer par statut
        if (!empty($status)) {
            $query = $query->where('status', $status);
        }

        // Filtrer par département
        if (!empty($department)) {
            $query = $query->where('department', $department);
        }

        // Paginer les résultats
        $total = $query->countAllResults(false);
        $users = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'default', $page);

        // Récupérer les rôles et départements uniques
        $roles = $this->userModel->select('DISTINCT role')->findAll();
        $departments = $this->userModel->select('DISTINCT department')->where('department !=', null)->findAll();
        $statuses = ['Actif', 'Inactif', 'Suspendu'];

        return view('utilisateurs', [
            'users' => $users,
            'pager' => $this->userModel->pager,
            'roles' => $roles,
            'departments' => $departments,
            'statuses' => $statuses,
            'search' => $search,
            'role' => $role,
            'status' => $status,
            'department' => $department,
            'total' => $total,
        ]);
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur
     */
    public function create()
    {
        return view('users/form');
    }

    /**
     * Sauvegarde un nouvel utilisateur
     */
    public function store()
    {
        $data = [
            'matricule' => $this->request->getPost('matricule'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'department' => $this->request->getPost('department'),
            'status' => $this->request->getPost('status') ?? 'Actif',
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/utilisateurs')->with('success', 'Utilisateur créé avec succès');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la création de l\'utilisateur');
        }
    }

    /**
     * Affiche les détails d'un utilisateur
     */
    public function view($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé');
        }

        return view('users/view', ['user' => $user]);
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé');
        }

        return view('users/form', ['user' => $user]);
    }

    /**
     * Met à jour un utilisateur
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'department' => $this->request->getPost('department'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/utilisateurs')->with('success', 'Utilisateur mis à jour avec succès');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de l\'utilisateur');
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'utilisateur');
        }
    }

    /**
     * Exporte les utilisateurs en CSV
     */
    public function export()
    {
        $users = $this->userModel->findAll();

        // Créer le fichier CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=utilisateurs_' . date('Y-m-d_H-i-s') . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Matricule', 'Nom', 'Email', 'Rôle', 'Département', 'Statut', 'Dernière connexion'], ';');

        foreach ($users as $user) {
            fputcsv($output, [
                $user['matricule'],
                $user['name'],
                $user['email'],
                $user['role'],
                $user['department'] ?? '-',
                $user['status'],
                $user['last_login'] ?? '-',
            ], ';');
        }

        fclose($output);
        exit;
    }
}
