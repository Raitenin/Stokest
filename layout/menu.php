<nav id="menu" class="navbar sticky-top navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler w-100" style="color: #383838;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-fill nav-justified w-100">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="saidas.php" class="nav-link"><i class="fa fa-arrow-right"></i> Saídas</a></li>
                    <li class="nav-item"><a href="entradas.php" class="nav-link"><i class="fa fa-arrow-left"></i> Entradas</a></li>
                    <li class="nav-item position-static dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Configurações</a>
                        <div class="dropdown-menu w-100 animate slideIn" aria-labelledby="navbarDropdown" id="" style="margin-top:-10px;overflow-y: auto;max-height: 500px;">
                            <div class="container">
                                <div class="row w-100">
                                    <div class="col-sm-4">
                                        <span class="dropdown-item mega-header-title">E/S</span>
                                        <a class="dropdown-item" href="motivoentrada.php" style="font-size: 14px">Motivo de Entrada</a>
                                        <a class="dropdown-item" href="motivosaida.php" style="font-size: 14px">Motivo de Saída</a>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="dropdown-item mega-header-title">Produtos</span>
                                        <a class="dropdown-item" href="estoque.php" style="font-size: 14px">Estoque</a>
                                        <a class="dropdown-item" href="adicionarProduto.php" style="font-size: 14px">Adicionar produto</a>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="dropdown-item mega-header-title">Usuários</span>
                                        <a class="dropdown-item" href="usuarios.php" style="font-size: 14px">Ver Todos</a>
                                        <a class="dropdown-item" href="adicionarUsuario.php" style="font-size: 14px">Adicionar Usuário</a>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>