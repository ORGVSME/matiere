<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> — SysInfo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <?php
    $userName = session()->get('name') ?? 'Utilisateur';
    $userEmail = session()->get('email') ?? 'user@example.com';
    $userInitials = strtoupper(substr($userName, 0, 2));
    
    if (!session()->get('is_logged_in')) {
        return redirect()->to('/');
    }
    ?>

    <div class="app">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <div class="brand-name">SysInfo</div>
                    <div class="brand-sub">v2.4.0</div>
                </div>
            </div>

            <div class="sidebar-section">Navigation</div>
            
            <a href="<?= base_url('dashboard') ?>" class="nav-item<?= (current_url(true)->getPath() === '/dashboard') ? ' active' : '' ?>">
                <svg viewBox="0 0 24 24">
                    <rect width="7" height="9" x="3" y="3" rx="1"/>
                    <rect width="7" height="5" x="14" y="3" rx="1"/>
                    <rect width="7" height="9" x="14" y="12" rx="1"/>
                    <rect width="7" height="5" x="3" y="16" rx="1"/>
                </svg>
                Tableau de bord
            </a>

            <a href="<?= base_url('utilisateurs') ?>" class="nav-item<?= (strpos(current_url(true)->getPath(), '/utilisateurs') !== false) ? ' active' : '' ?>">
                <svg viewBox="0 0 24 24">
                    <path d="M18 21H6a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2z"/>
                    <path d="M12 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                </svg>
                Utilisateurs
                <span class="nav-badge">24</span>
            </a>

            <div class="sidebar-section">Système</div>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="1"/>
                    <path d="M12 1v6m0 6v6"/>
                </svg>
                Paramètres
            </a>
        </aside>

        <!-- Main Content -->
        <div class="main">
            <!-- Header -->
            <header class="app-header">
                <div class="header-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <svg viewBox="0 0 24 24" width="20" height="20">
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                    <div class="header-title">
                        <h2><?= $this->renderSection('page_title') ?></h2>
                    </div>
                </div>

                <div class="header-right">
                    <div class="user-menu">
                        <div class="user-avatar"><?= $userInitials ?></div>
                        <div class="user-info">
                            <div class="user-name"><?= esc($userName) ?></div>
                            <div class="user-role">Super administrateur</div>
                        </div>
                        <div class="dropdown-menu">
                            <a href="<?= base_url('logout') ?>" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="app-content">
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 SysInfo. Tous droits réservés.</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.app').classList.toggle('sidebar-collapsed');
        });
    </script>
</body>
</html>
