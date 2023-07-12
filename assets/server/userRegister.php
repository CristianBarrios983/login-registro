<?php
    session_start();
    require("conexion.php");

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    //Se verifica si el email existe en la base de datos
    $queryCheckEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);

    if(mysqli_num_rows($resultCheckEmail) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El email ingresado ya está en uso";
        header("Location: ../../register.php");
        exit();
    }else{

        //Si el email no se encuentra en la base de datos, se procede con el registro
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (name, surname, email, pass) VALUES ('$name','$surname','$email','$hash')";

        if(mysqli_query($conn, $query)){
            //Guardando mensaje en una variable de session
            $_SESSION['mensaje'] = "Registrado exitosamente";
            header("Location: ../../index.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo registrar";
            header("Location: ../../register.php");
            exit();
        }
    }
?>