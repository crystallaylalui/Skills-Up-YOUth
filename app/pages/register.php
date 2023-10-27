<?php
session_start();
// No session variable "user" => no login
if (isset($_SESSION["user_id"]) ) {
     // redirect to login page
     header("Location: homepage.php");
     exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid vh-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Skill Up Youth!</a>
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
            </div>
        </nav>
        <div class="row d-flex align-items-center h-75">
            <div class="col-md-8 col-12">
                <img class="w-50 mx-auto d-block" src="../images/register.svg">
            </div>
            
            <div class="col-md-2 col-12">
                <h1>Register!</h1>
                <br>
                <div class="h6">Username</div>
                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" v-model="username">
                </div>
                <div class="h6">Email</div>
                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" v-model="email">
                </div>
                <div class="h6">Password</div>
                <div class="input-group mb-4">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" v-model="password">
                </div>
                <br>
                <div class="d-flex justify-content-end">
                    <button v-on:click="registerUser" class="btn confirm-button">Register</button>
                </div>
                

                
                <p class="signup py-5 text-center">Already have an account? <a href="../index.php">Login</a></p>
            </div>
        </div>
    </div>
    
    <script>
        Vue.createApp({
            data() {
                return {
                    username: '',
                    password: '',
                    email: '',
                };
            },
            methods: {
                registerUser() {
                    console.warn(this.username,this.password,this.email);
                    const user = {
                        username: this.username,
                        password: this.password,
                        email: this.email,
                    }
                    axios.post('../../server/api/register.php', user)
                    .then((res) => {
                        if (res.data) {
                            console.log(res.data);
                            alert("Registration Successful");
                            window.location.href = "../index.php";
                        } else {
                            alert("Registration fail");
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },
        }).mount('body');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>