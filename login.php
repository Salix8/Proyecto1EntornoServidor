<?php
    $title = "Contact";
    require_once "./utils/utils.php";
    require_once "./utils/Forms/InputElement.php";
    require_once "./utils/Forms/PasswordElement.php";
    require_once "./utils/Forms/FormElement.php";
    require_once "./utils/Forms/TextareaElement.php";
    require_once "./utils/Forms/ButtonElement.php";
    require_once "./utils/Forms/FormElement.php";
    require_once "./utils/Forms/custom/MyFormGroup.php";
    require_once "./utils/Forms/custom/MyFormControl.php";
    require_once "./utils/Validator/NotEmptyValidator.php";
    require_once "./entity/Usuario.php";
    require_once "./repository/UsuarioRepository.php.php";
    require_once "./core/App.php";

    $config = require_once 'app/config.php';
    App::bind("config", $config);
    App::bind("connection", Connection::make($config['database']));
    $repositorio = new UsuarioRepository();

    session_start();

    $info = "";

    $nombreUsuario = new InputElement('text');

    $nombreUsuario

      ->setName('username')

      ->setId('username');

    $nombreUsuario->setValidator(new NotEmptyValidator('El nombre de usuari@ no puede estar vacío', true));

    $userWrapper = new MyFormControl($nombreUsuario, 'Nombre de usuari@', 'col-xs-12');

    $pass = new PasswordElement();

    $pass

      ->setName('password')

      ->setId('password');

    $passWrapper = new MyFormControl($pass, 'Contraseña', 'col-xs-12');

    $b = new ButtonElement("Resgistro", "", "", "pull-right btn btn-lg sr-button");

    $form = new FormElement();

    $form
    ->appendChild($userWrapper)
    ->appendChild($passWrapper)
    ->appendChild($b);

    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        $form->validate();
        if (!$form-harError()) {
            try {
                $usuario = $repositorio->findByUserNameAndPassword($nombreUsuario->getValue(), $pass->getValue());
                $_SESSION["usurname"] = $usuario->getUsername();
                header("location: /");
            } catch (QueryException $qe ){
                $form->addError($qe->getMessage());
            } catch (NotFoundException $err){
                $form->addError($err->getMessage());
            } catch (Exception $err){
                $form->addError($err->getMessage());
            }
        }
    }


    
