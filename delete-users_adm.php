<?php
    require_once 'authentication_adm.php';
    require_once 'classes/Usuario.php';
    require 'error.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/table-user.css">
    <title>Excluir Usuários</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

        <main class="main">

            <section class="login" id="sec-del">

                <?php

                    if (isset($_SESSION['div-delete-users'])) {

                        echo $_SESSION['div-delete-users'];
                        unset($_SESSION['div-delete-users']);
                    }

                    if (isset($_SESSION['msg-delete-user'])) {

                        echo $_SESSION['msg-delete-user'];
                        unset($_SESSION['msg-delete-user']);
                        
                    }

                ?>
                
                <h1>Relação de usuários cadastrados</h1>

                <div class="container-table">
        
                    <?php

                        $u = new Usuario();

                        $usuario = $u->relacaoUsuarios();

                        if ($usuario > 0) {

                        ?>
    
                            <table class='table'>

                                    <thead class='cabecalho'>
                                        <tr>

                                            <th>
                                                Nome
                                            </th>

                                            <th>
                                                E-mail
                                            </th>

                                            <th>
                                                Excluir Usuário
                                            </th>

                                        </tr>
                                    </thead>

                        <?php

                            for ($c = 0; $c < count($usuario); $c++) {

                                $id_del_user = array();

                                $id_del_user = md5($usuario[$c]['id_usuario']);

                                echo "<tbody>
                                        <tr>

                                            <th>
                                                {$usuario[$c]['nome']}
                                            </th>

                                            <th>
                                                {$usuario[$c]['email']}
                                            </th>

                                            <th>";
                                                echo "<button id='del-user'><a href='delete-popup-users.php?del_user=$id_del_user'>Excluir</a></button>";
                                            echo "</th>";

                                    echo "</tr>

                                    <tbody>";

                            }

                        ?>

                            </table>

                        <?php

                        } else {

                            $id_del_user = NULL;

                            ?>

                            <table class='table'>

                                <thead class='cabecalho'>

                                    <tr>

                                        <th>
                                            Nome
                                        </th>

                                        <th>
                                            E-mail
                                        </th>

                                        <th>
                                            Excluir Usuário
                                        </th>

                                    </tr>

                                </thead>";

                                <tbody>
                                
                                    <tr>

                                        <th>
                                            Nenhum usuário encontrado
                                        </th>

                                        <th>
                                            Nenhum e-mail encontrado
                                        </th>

                                        <th>
                                            <?php
                                                echo "<button id='del-user'><a href='delete-popup-users.php?del_user=$id_del_user'>Excluir</a></button>";
                                            ?>
                                        </th>

                                    </tr>
                        
                                </tbody>

                            </table>

                        <?php

                        }

                    ?>
                </div>

            </section>
            
        </main>

        <?php
            require_once 'footer.php';
        ?>

    </div>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</body>
</html>