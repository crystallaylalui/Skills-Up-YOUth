<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../css/leaderboardstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div>
            <?php include ('navbar.php'); ?>
        </div>

        <div>
            <div class="table">
                <section class="table__header">
                    <h1>Leaderboard</h1>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> Student Id </th>
                                <th> Name </th>
                                <th> Level </th>
                                <th> Number of Points </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong> 1 </strong></td>
                                <td> <img src="../images/guy1.jpg" alt="">Alex Chan</td>
                                <td>
                                    <p class="status expert">Coding Expert</p>
                                </td>
                                <td> <strong> 100 </strong></td>
                            </tr>
                            <tr>
                                <td><strong> 2 </strong></td>
                                <td><img src="../images/guy2.jpg" alt="">Shawn Lim</td>
                                <td>
                                    <p class="status expert">Coding Expert</p>
                                </td>
                                <td> <strong>90</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 3 </strong></td>
                                <td><img src="../images/girl1.jpg" alt=""> Chloe Tan </td>
                                <td>
                                    <p class="status whiz">Tech Whiz</p>
                                </td>
                                <td> <strong>80</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 4 </strong></td>
                                <td><img src="../images/guy3.jpg" alt=""> Elson Chua </td>
                                <td>
                                    <p class="status whiz">Tech Whiz</p>
                                </td>
                                <td> <strong>70</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 5 </strong></td>
                                <td><img src="../images/girl2.png" alt=""> Rachel Lee </td>
                                <td>
                                    <p class="status proficient">Proficient Coder</p>
                                </td>
                                <td> <strong>60</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 6 </strong></td>
                                <td><img src="../images/guy4.jpg" alt=""> Ali Abdul </td>
                                <td>
                                    <p class="status proficient">Proficient Coder</p>
                                </td>
                                <td> <strong>50</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 7 </strong></td>
                                <td><img src="../images/guy5.jpg" alt=""> Fernando Alonso </td>
                                <td>
                                    <p class="status intermediate">Intermediate</p>
                                </td>
                                <td> <strong>40</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 8 </strong></td>
                                <td><img src="../images/girl3.jpg" alt=""> Aayat Ali Khan </td>
                                <td>
                                    <p class="status intermediate">Intermediate</p>
                                </td>
                                <td> <strong>30</strong> </td>
                            </tr>
                            <tr>
                                <td><strong> 9 </strong></td>
                                <td><img src="../images/guy6.jpg" alt=""> Cody Chua </td>
                                <td>
                                    <p class="status intermediate">Intermediate</p>
                                </td>
                                <td> <strong>20</strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        
    </div>
    
</body>

</html>