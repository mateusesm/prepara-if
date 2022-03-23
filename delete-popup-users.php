<?php

    require_once 'authentication_adm.php';

    $id_del_user = $_GET['del_user'];

    $_SESSION['div-delete-users'] = "<div class='ic-delete'>

        <img  id='sad-face-delete' src='images/sad-face.jpg' alt='Sad face'/>

        <form class='form-delete-acount' action='delete-users.php?del_user=$id_del_user' method='POST'>

            <p id='delete-confirm'>

                 Digite sua senha e confirme a exclusão de usuário.

            </p>

            <p><label for='password'></label>

            <i class='fas fa-lock del-user'></i>

            <input class='box' id='password-popup' type='password' name='password-popup' maxlength='20' placeholder='Senha atual'></p>

            <div class='buttons-delete'>

                <input class='button-yes-delete' type='submit' value='Excluir usuário' name='delete-acount'>

                <div class='button-no-delete'>
                    <a href='delete-users_adm.php'>Cancelar</a>
                </div>

            </div>

        </form>

    </div>";

    header('location: delete-users_adm.php');
