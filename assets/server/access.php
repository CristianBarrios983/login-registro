<?php
    require("conexion.php");

    session_start();

    $email=$_POST["email"];
    $pass=$_POST["pass"];

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $hash = $row['pass'];

        if(password_verify($pass, $hash)){
            $_SESSION['email'] = $email;
            header("Location: ../../dashboard.php");
            exit();
        }else{
            //Contraseña incorrecta
            $_SESSION['mensaje'] = "Contraseña incorrecta. Intentelo de nuevo";
            header("Location: ../../index.php");
            exit();
        }
    }else{
        //Usuario no encontrado
        $_SESSION['mensaje'] = "Usuario no encontrado";
        header("Location: ../../index.php");
        exit();
    }

    //Cerrar la conexion
    mysqli_close($conn);    
   
?>