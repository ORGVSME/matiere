<?php
$this->extend('layouts/main');
$this->section('title', 'Gestion des utilisateurs');
$this->section('page_title', 'Gestion des utilisateurs');
$this->section('content');
?>

<div class="container-fluid">
    <!-- Affichage des messages flash -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- En-tête avec titre et boutons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Liste des utilisateurs</h1>
            <small class="text-muted">Accueil / Utilisateurs</small>
        </div>
        <div>
            <a href="<?= site_url('/utilisateurs/export') ?>" class="btn btn-outline-primary me-2" title="Exporter les utilisateurs">
                <i class="bi bi-download"></i> Exporter
            </a>
            <a href="<?= site_url('/utilisateurs/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvel utilisateur
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?= site_url('/utilisateurs') ?>" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="search" class="form-label">Rechercher un utilisateur...</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Nom, email, matricule..." value="<?= esc($search) ?>">
                </div>

                <div class="col-md-2">
                    <label for="role" class="form-label">Tous les rôles</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">Sélectionner...</option>
                        <?php foreach ($roles as $r): ?>
                            <option value="<?= esc($r['role']) ?>" 
                                <?= ($r['role'] === $role) ? 'selected' : '' ?>>
                                <?= esc($r['role']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="status" class="form-label">Tous les statuts</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Sélectionner...</option>
                        <?php foreach ($statuses as $s): ?>
                            <option value="<?= esc($s) ?>" <?= ($s === $status) ? 'selected' : '' ?>>
                                <?= esc($s) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="department" class="form-label">Département</label>
                    <select class="form-select" id="department" name="department">
                        <option value="">Sélectionner...</option>
                        <?php foreach ($departments as $d): ?>
                            <option value="<?= esc($d['department']) ?>" 
                                <?= ($d['department'] === $department) ? 'selected' : '' ?>>
                                <?= esc($d['department']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filtrer les avancés
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 30px;">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                        </th>
                        <th>UTILISATEUR</th>
                        <th>MATRICULE</th>
                        <th>RÔLE</th>
                        <th>DÉPARTEMENT</th>
                        <th>DERNIÈRE CONNEXION</th>
                        <th>STATUT</th>
                        <th class="text-center" style="width: 120px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input user-checkbox" type="checkbox" 
                                           value="<?= $user['id'] ?>">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 36px; height: 36px; font-size: 14px; font-weight: bold; flex-shrink: 0;">
                                            <?= strtoupper(substr($user['name'], 0, 2)) ?>
                                        </div>
                                        <div>
                                            <strong class="d-block"><?= esc($user['name']) ?></strong>
                                            <small class="text-muted"><?= esc($user['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><code><?= esc($user['matricule']) ?></code></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= esc($user['role']) ?>
                                    </span>
                                </td>
                                <td><?= esc($user['department'] ?? '—') ?></td>
                                <td>
                                    <?php if ($user['last_login']): ?>
                                        <small><?= date('Y-m-d H:i', strtotime($user['last_login'])) ?></small>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                                <td>
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
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= site_url('/utilisateurs/view/' . $user['id']) ?>" 
                                           class="btn btn-outline-secondary" title="Voir" data-bs-toggle="tooltip">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= site_url('/utilisateurs/edit/' . $user['id']) ?>" 
                                           class="btn btn-outline-secondary" title="Éditer" data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= site_url('/utilisateurs/delete/' . $user['id']) ?>" 
                                           class="btn btn-outline-danger" title="Supprimer" data-bs-toggle="tooltip"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                <strong>Aucun utilisateur trouvé</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if (!empty($users)): ?>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Affichage de 1–<?= min(6, count($users)) ?> sur <?= $total ?> entrées
                    </small>
                    <?php if ($pager): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                <?= $pager->links('default', 'bootstrap_pagination') ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: bold;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa !important;
    }

    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    code {
        background-color: #f5f5f5;
        padding: 0.2rem 0.4rem;
        border-radius: 3px;
        color: #d63384;
    }
</style>

<script>
    // Sélectionner tous les utilisateurs
    document.getElementById('selectAll')?.addEventListener('change', function() {
        document.querySelectorAll('.user-checkbox').forEach(cb => {
            cb.checked = this.checked;
        });
    });

    // Mettre à jour le statut du checkbox "Sélectionner tout"
    document.querySelectorAll('.user-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const allChecked = document.querySelectorAll('.user-checkbox:not(:checked)').length === 0;
            document.getElementById('selectAll').checked = allChecked;
        });
    });

    // Activer les tooltips Bootstrap
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });
</script>

<?php $this->endSection(); ?>
