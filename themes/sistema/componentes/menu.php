<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <h1 class="display-4">Gest <b>Residents</b></h1>
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("home") ?>">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("encomendas") ?>">
                            <i class="fas fa-shipping-fast text-danger"></i>
                            <span class="nav-link-text">Encomendas</span>
                        </a>
                    </li>
                    <?php if (sindico(\Source\Models\Autenticacao::usuario())): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("apartamentos") ?>">
                                <i class="fas fa-building text-danger"></i>
                                <span class="nav-link-text">Apartamentos</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("moradores") ?>">
                            <i class="fas fa-users text-danger"></i>
                            <span class="nav-link-text">Moradores</span>
                        </a>
                    </li>
                    <?php if (sindico(\Source\Models\Autenticacao::usuario())): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("usuarios") ?>">
                                <i class="fas fa-user-cog text-danger"></i>
                                <span class="nav-link-text">Usuários</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <hr class="my-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("sair") ?>">
                            <i class="fas fa-sign-out-alt text-danger"></i>
                            <span class="nav-link-text">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


