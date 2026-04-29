<?php

namespace App\Controllers;

class Pages extends BaseController
{
    /**
     * Affiche la page utilisateurs (simple wrapper pour la vue)
     */
    public function utilisateurs(): string
    {
        return view('utilisateurs');
    }

    /**
     * Affiche le formulaire de création/modification d'utilisateur
     */
    public function form(): string
    {
        return view('form');
    }
}
