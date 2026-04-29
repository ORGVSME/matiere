<?php
$this->extend('layouts/main');
$this->section('content');

$isEdit = isset($user);
$pageTitle = $isEdit ? 'Modifier un utilisateur' : 'Créer un nouvel utilisateur';
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= $pageTitle ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= $isEdit ? site_url('/utilisateurs/update/' . $user['id']) : site_url('/utilisateurs/store') ?>">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="matricule" class="form-label">Matricule *</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" 
                                       value="<?= esc($user['matricule'] ?? '') ?>" required<?= $isEdit ? ' readonly' : '' ?>>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom complet *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?= esc($user['name'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= esc($user['email'] ?? '') ?>" required<?= $isEdit ? ' readonly' : '' ?>>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label"><?= $isEdit ? 'Nouveau mot de passe (optionnel)' : 'Mot de passe *' ?></label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       <?= !$isEdit ? 'required' : '' ?>>
                                <small class="text-muted">
                                    <?= $isEdit ? 'Laissez vide pour garder le mot de passe actuel' : 'Minimum 8 caractères' ?>
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Rôle *</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">-- Sélectionnez un rôle --</option>
                                    <option value="Administrateur" <?= (isset($user) && $user['role'] === 'Administrateur') ? 'selected' : '' ?>>
                                        Administrateur
                                    </option>
                                    <option value="Gestionnaire" <?= (isset($user) && $user['role'] === 'Gestionnaire') ? 'selected' : '' ?>>
                                        Gestionnaire
                                    </option>
                                    <option value="Auditeur" <?= (isset($user) && $user['role'] === 'Auditeur') ? 'selected' : '' ?>>
                                        Auditeur
                                    </option>
                                    <option value="Opérateur" <?= (isset($user) && $user['role'] === 'Opérateur') ? 'selected' : '' ?>>
                                        Opérateur
                                    </option>
                                    <option value="Utilisateur" <?= (isset($user) && $user['role'] === 'Utilisateur') ? 'selected' : '' ?>>
                                        Utilisateur
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="department" class="form-label">Département</label>
                                <select class="form-select" id="department" name="department">
                                    <option value="">-- Sélectionnez un département --</option>
                                    <option value="DSI" <?= (isset($user) && $user['department'] === 'DSI') ? 'selected' : '' ?>>
                                        DSI
                                    </option>
                                    <option value="Finance" <?= (isset($user) && $user['department'] === 'Finance') ? 'selected' : '' ?>>
                                        Finance
                                    </option>
                                    <option value="RH" <?= (isset($user) && $user['department'] === 'RH') ? 'selected' : '' ?>>
                                        RH
                                    </option>
                                    <option value="Commercial" <?= (isset($user) && $user['department'] === 'Commercial') ? 'selected' : '' ?>>
                                        Commercial
                                    </option>
                                </select>
                            </div>
                        </div>

                        <?php if ($isEdit): ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Statut *</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Actif" <?= ($user['status'] === 'Actif') ? 'selected' : '' ?>>Actif</option>
                                        <option value="Inactif" <?= ($user['status'] === 'Inactif') ? 'selected' : '' ?>>Inactif</option>
                                        <option value="Suspendu" <?= ($user['status'] === 'Suspendu') ? 'selected' : '' ?>>Suspendu</option>
                                    </select>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="status" value="Actif">
                        <?php endif; ?>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> 
                                <?= $isEdit ? 'Mettre à jour' : 'Créer' ?>
                            </button>
                            <a href="<?= site_url('/utilisateurs') ?>" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
