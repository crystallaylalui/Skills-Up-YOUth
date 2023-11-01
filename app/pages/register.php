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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link href="../css/style.css" rel="stylesheet">
</head>
<body style="background-color:white">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:black">
        <div class="container-fluid">
            <img src="../images/logo.jpg" height="45" alt="logo" />
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        </div>
    </nav>

    <div class="main-banner" id="top">
        <div class="container">
        <div class="row">
            <div class="col-lg-7">
            <div class="caption header-text">
                <!-- logo of skill up youth -->
                <div class="animate__animated animate__slideInLeft">
                <h4>Dive <em>Into The Tech World </em> <br> with <span> Skills-Up Youth</span></h4>
                </div>
                <p class="registration-desc">Skill-up Youth provides essential educational and employment-related <br>resources to under-privileged youths  (aged 15-35) to ensure inclusive, <br> quality education and job opportunities for all. </p>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="services section" id="services">
        <div class="container">
            <div class="row">
            <div class="container-fluid vh-100 mt-5 p-5 registration-bg">
        <div class="row d-flex align-items-center h-75">
            <div class="col-md-8 col-12">

            </div>

            <div class="col-md-4 col-12>
                <div class="mt-5 p-3">
                <h2 class="text-center m-3 p-3">Register</h2>
                <div class="registration-form" id="register">
                    <div class="form-group">
                        <input type="text" id="username" class="form-control" placeholder="Username" v-model="username">
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" class="form-control" placeholder="Email" v-model="email">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control" placeholder="Password" v-model="password">
                    </div>
                    <br>
                    <div class="d-flex justify-content-end">
                        <button v-on:click="registerUser" class="btn confirm-button">Register</button>
                    </div>
                </div>
                <p class="signup py-5 text-center">Already have an account? <a href="../index.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
        
    </div>


    
    <script>
        const register = Vue.createApp({
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
        })
        
        const vm = register.mount('#register');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>