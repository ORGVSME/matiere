<?php

namespace App\Controllers;

use App\Models\User;

class Home extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Affiche la page de connexion
     */
    public function login(): string
    {
        return view('login');
    }

    /**
     * Traite la soumission du formulaire de connexion
     */
    public function authenticate()
    {
        // Récupérer les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Valider les données
        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Email et mot de passe requis');
        }

        // Authentifier l'utilisateur
        $user = $this->userModel->authenticate($email, $password);

        if ($user) {
            // Créer une session utilisateur
            session()->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'] ?? 'Utilisateur',
                'is_logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            // Authentification échouée
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
    }

    /**
     * Affiche le tableau de bord
     */
    public function dashboard(): string
    {
        return view('dashboard');
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
