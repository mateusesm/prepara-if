<?php

    require_once 'authentication.php';

    $_SESSION['div-delete'] = "<div class='ic-delete'>

        <img  id='sad-face-delete' src='images/sad-face.jpg' alt='Sad face'/>

            <p id='delete-sad'>

                É uma pena ver você partir...

            </p>

        <form class='form-delete-acount' action='delete-acount.php' method='POST'>

            <p id='delete-confirm'>

                 Digite sua senha e confirme a exclusão.

            </p>

            <p><label for='password'></label>

            <i class='fas fa-lock'></i>

            <input class='box' id='password-popup' type='password' name='password-popup' maxlength='20' placeholder='Senha atual'></p>

            <div class='buttons-delete'>

                <input class='button-yes-delete' type='submit' value='Sim, quero excluir minha conta' name='delete-acount'>

                <div class='button-no-delete'>
                    <a href='edit-profile.php'>Quero continuar com a conta</a>
                </div>

            </div>

        </form>

    </div>";

    header('location: edit-profile.php');
