<?php
    session_start();

    //Verifica si la sesion esta iniciada
    if(!isset($_SESSION['email'])){
      //Redirigir a la pagina de login
      header("Location: index.php");
      exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Menu</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="assets/server/exit.php"><i class="bi bi-box-arrow-right text-warning"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>



      <div class="container">
        <h1 class="mb-3">Bienvenido <?php echo $_SESSION['email']; ?></h1>
        <?php
        //Validando para que solo el que tenga email de admin@gmail.com pueda ver esta card
        if ($_SESSION['email'] === 'admin@gmail.com') {
        ?>
        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
          <div class="card-header"></div>
          <div class="card-body">
            <h5 class="card-title">Usuarios</h5>
            <?php 
              require('assets/server/conexion.php');

              //Se realiza la consulta para contar el numero de usuarios
              $query = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
              $result = mysqli_query($conn, $query);

              //Obtener el resultado de la consulta
              $row = mysqli_fetch_assoc($result);
              $total_usuarios = $row['total_usuarios'];
            ?>
            <p class="card-text"><?php echo $total_usuarios; ?></p>
          </div>
        </div>
        <?php
          }
        ?>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>