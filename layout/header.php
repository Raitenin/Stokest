<?php $user = usuarioAtual(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Controle de estoque Stokest">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title><?php echo $titulo_pagina; ?></title>
</head>

<body>
    
<header>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3" style="text-align: center;">
                    <div id="logo">
                        <a href="dashboard.php"><img src="img/logo.png" title="Stokest" alt="Stokest" class="img-responsive" style="width: 100%;max-width:200px;"></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-9">
                    <div class="row">
                        <div class="col-sm-8" style="text-align: center; color: #eee">
                            <span class="">Nome da Empresa</span>
                        </div>
                        <div class="col-sm-4" style="text-align: center; color: #eee">
                            <div class="top-header">

                                <div class="dropdown">
                                    <a class="dropdown-toggle" style="color: #eee; text-decoration: none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> <?php echo $user['nome']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="alterarSenha.php">Alterar Senha</a>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>