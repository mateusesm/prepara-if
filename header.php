<header class="header">
            <div class="container-menu">
                <a href="main.php"><h1 class="logo">Prepara IF</h1></a>

               <nav id="menu">

                    <button aria-label="Abrir Menu" class="botao-mobile" aria-haspopup="true" aria-controls="menu-section" aria-expanded="false">

                        <div class="hamburguer"></div>

                    </button>

                    <ul class="menu-section" role="menu">
    
                        <li><a href="#">Ajuda</a></li>
                        <li><a href="#">Fale conosco</a></li>
                        <li><a href="#">Editar Perfil</a></li>
                        <?php

                            if ($_SESSION['nivel'] == 2) {

                            ?>

                                <li><a href="upload-files.php">Adicionar provas e gabaritos</a></li>
                                <li><a href="reg_adm.php">Novo Administrador</a></li>
                                <li><a href="#" id="del">Excluir Usuários</a></li>

                            <?php

                            }

                        ?>
                        <li><a href="get-out.php" id="sair">Sair</a></li>
                
                    </ul>
                </nav>
            </div>
    </header>