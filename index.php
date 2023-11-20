<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "static/include/head.php"; ?>
    <?php include "static/function/authenticate.php"; ?>
    <title>Login</title>
</head>

<style>
    .btn-color {
        background-color: #0e1c36;
        color: #fff;

    }

    .profile-image-pic {
        height: 180px;
        width: 180px;
        object-fit: cover;
    }



    .cardbody-color {
        background-color: #ebf2fa;
    }

    a {
        text-decoration: none;
    }

    #ini:hover {
         background-color: #536382;
         color:#ebf2fa;
    }
</style>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Laboratorio remoto de sistemas embebidos</h2>
                <div class="text-center mb-5 text-dark"></div>
                <div class="card my-5">


                    <div class="card-body cardbody-color p-lg-5">

                    <!-- <form method="POST" action='static/function/login.php'>

                        <div class="text-center">
                            <img src="static/assets/img/userLogin.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Usuario" name="username" required="" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required>
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100" id="ini">Iniciar Sesión</button></div>
                    </form>

                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">No estas registrado? <a href='register.php' class="text-dark fw-bold"> Create una cuenta</a>
                    </div> -->

                    </div>
                
                </div>

            </div>
        </div>
    </div>

</body>

</html>