<?php
session_start();
// No session variable "user" => no login
if (isset($_SESSION["user_id"]) ) {
     // redirect to login page
     header("Location: pages/homepage.php");
     exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="css/style.css" rel="stylesheet">
</head>
<body class="login-background">

    <div id="login" class="container-fluid vh-100 ">

        <div class="row">
            <div class="col-md-7 col-12" style="padding-left:80px;">
                <!-- Add an image here -->
                <img src="images/login-pic.png" alt="login-background" class="img-fluid responsive-image">

            </div>
            
            <div class="col-lg-5 col-md-10">
                <div class="mt-3" style="padding-left:40px; padding-right:80px; padding-top:100px;text-align:center;">
                    <img src="images/logo1.png" width="300" alt="Skills Up Logo" style="padding-bottom:50px">
                    
                    <h1 class="mt-2" style="color:white">Log in</h1>
                    <br>
                    <div class="form-group-2">
                        <div class="form-group-2">
                            <input type="text" class="form-control-2" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" v-model="username">
                        </div>
                        <div class="form-group-2">
                            <input type="password" class="form-control-2" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" v-model="password">
                        </div>
                    <br>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button v-on:click="loginUser" class="btn confirm-button">Login</button>
                    </div>
                    
                    <p class="login py-5 text-center">Don't have an account? <a href="pages/register.php" style="color:white">Register here.</a></p>

                </div>
            </div>
        </div>  
    </div>
    
    <script>
        const login = Vue.createApp({
            data() {
                return {
                    username: '',
                    password: '',
                };
            },
            methods: {
                loginUser() {
                    // console.warn(this.username,this.password);
                    const user = {
                        username: this.username,
                        password: this.password,
                    }
                    axios.post('../server/api/login.php', user)
                    .then((res) => {
                        if (res.data) {
                            alert("Login Successful");
                            window.location.href = "pages/homepage.php";
                        } else {
                            alert("Login fail");
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },
        })
        const vm = login.mount('#login');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>