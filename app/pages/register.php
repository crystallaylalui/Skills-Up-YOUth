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
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:black">
        <div class="container-fluid">
            <img src="../images/logo.jpg" height="45" alt="logo" />
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        </div>
    </nav>
    <div class="container-fluid vh-100 p-5" style="background-color:aliceblue">
        <div class="row d-flex align-items-center h-75">
            <div class="col-md-8 col-12 pt-5">
                <h4 class="text-center" style="color:steelblue">Upskill by Learning New Skills Online</h4>
                <p class="h1 fw-bold text-center mb-5 animate__animated animate__fadeInLeftBig" style="font-family:'Times New Roman', Times, serif">Become a freelance programmer today</p>
                
                <img class="w-50 mx-auto d-block" src="../images/hero-header.png">
            </div>

            
            
        <div class="col-md-3 col-12 mt-5 p-3" style="background-color:white; border-radius: 10px; border: 2px solid black;">
            <h4 class="text-center m-3 p-3">Register</h4>
            <div class="registration-form">
                <div class="form-group">
                    <input type="text" id="username" class="form-control" placeholder="Username" v-model="username">
                </div>

                <div class="form-group">
                    <input type="text" id="email" class="form-control" placeholder="Email" v-model="email">
                </div>

                <div class="form-group">
                    <input type="password" id="password" class="form-control" placeholder="Password" v-model="password">
                </div>


                <div class="d-flex justify-content-end">
                    <button v-on:click="registerUser" class="btn confirm-button">Register</button>
                </div>
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