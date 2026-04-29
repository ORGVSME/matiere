<?php
$this->extend('layouts/main');
$this->section('content');
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Détails de l'utilisateur</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center mb-4">
                            <div class="avatar avatar-lg bg-primary text-white" 
                                 style="width: 80px; height: 80px; font-size: 32px; font-weight: bold; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                                <?= strtoupper(substr($user['name'], 0, 2)) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Matricule</label>
                            <p class="fw-bold"><?= esc($user['matricule']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Statut</label>
                            <p>
                                <?php 
                                $statusClass = match($user['status']) {
                                    'Actif' => 'success',
                                    'Inactif' => 'warning',
                                    'Suspendu' => 'danger',
                                    default => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?= $statusClass ?>">
                                    <?= esc($user['status']) ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nom complet</label>
                            <p class="fw-bold"><?= esc($user['name']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Email</label>
                            <p><?= esc($user['email']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Rôle</label>
                            <p>
                                <span class="badge bg-info text-dark">
                                    <?= esc($user['role']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Département</label>
                            <p><?= esc($user['department'] ?? '-') ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Date de création</label>
                            <p><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Dernière connexion</label>
                            <p><?= $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : '-' ?></p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= site_url('/utilisateurs/edit/' . $user['id']) ?>" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Éditer
                        </a>
                        <a href="<?= site_url('/utilisateurs') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
