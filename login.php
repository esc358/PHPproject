<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-none d-sm-block">
                <img src="img/login.jpg" alt="" class="img-fluid">
            </div>
            <div class="col d-flex">
                <div class="align-self-center">
                    <h1 class="text-center hs-5 py-3">ACCOUNT LOGIN</h1>
                    <form method="POST" class="row">
                        <div class="row">
                            <div class="form-floating mb-4">
                                <input type="email" required autocomplete="email" autofocus id="email" placeholder="name@example.com" class="rounded-0 form-control" name="email">   
                                <label for="email" class="px-4">Email Address</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-floating mb-4">
                                <input type="password" required id="password" placeholder="password" class="rounded-0 form-control" name="password">   
                                <label for="password" class="px-4">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn text-dark btn-lg mb-4 w-100" style="background-color: #ddd">Sign In</button>
                            </div>
                            <div class="col">
                                <a href="register.php" class="btn btn-success btn-lg mb-4 w-100">Sign Up</a>
                            </div>
                        </div>
                    </form>
                    
                    <p class="text-danger"><strong>Invalid Username or Password</strong></p>
                   
                </div>

            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>