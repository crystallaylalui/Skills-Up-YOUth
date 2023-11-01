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
                                <th> Student Id <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Location <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Start Date <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Level <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Number of badges <span class="icon-arrow">&UpArrow;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 1 </td>
                                <td class="name"> <img src="../images/guy1.jpg" alt="">Alex Chan</td>
                                <td> Seoul </td>
                                <td> 17 Dec, 2022 </td>
                                <td>
                                    <p class="status expert">Coding Expert</p>
                                </td>
                                <td> <strong> 100 </strong></td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td class="name"><img src="../images/guy2.jpg" alt="">Shawn Lim</td>
                                <td> Kathmandu </td>
                                <td> 27 Aug, 2023 </td>
                                <td>
                                    <p class="status expert">Coding Expert</p>
                                </td>
                                <td> <strong>90</strong> </td>
                            </tr>
                            <tr>
                                <td> 3</td>
                                <td class="name"><img src="../images/girl1.jpg" alt=""> Chloe Tan </td>
                                <td> Tokyo </td>
                                <td> 14 Mar, 2023 </td>
                                <td>
                                    <p class="status whiz">Tech Whiz</p>
                                </td>
                                <td> <strong>80</strong> </td>
                            </tr>
                            <tr>
                                <td> 4</td>
                                <td class="name"><img src="../images/guy3.jpg" alt=""> Elson Chua </td>
                                <td> New Delhi </td>
                                <td> 25 May, 2023 </td>
                                <td>
                                    <p class="status whiz">Tech Whiz</p>
                                </td>
                                <td> <strong>70</strong> </td>
                            </tr>
                            <tr>
                                <td> 5</td>
                                <td class="name"><img src="../images/girl2.png" alt=""> Rachel Lee </td>
                                <td> Paris </td>
                                <td> 23 Apr, 2023 </td>
                                <td>
                                    <p class="status proficient">Proficient Coder</p>
                                </td>
                                <td> <strong>60</strong> </td>
                            </tr>
                            <tr>
                                <td> 6</td>
                                <td class="name"><img src="../images/guy4.jpg" alt=""> Ali Abdul </td>
                                <td> London </td>
                                <td> 23 Apr, 2023 </td>
                                <td>
                                    <p class="status proficient">Proficient Coder</p>
                                </td>
                                <td> <strong>50</strong> </td>
                            </tr>
                            <tr>
                                <td> 7</td>
                                <td class="name"><img src="../images/guy5.jpg" alt=""> Fernando Alonso </td>
                                <td> New York </td>
                                <td> 20 May, 2023 </td>
                                <td>
                                    <p class="status intermediate">Intermediate</p>
                                </td>
                                <td> <strong>40</strong> </td>
                            </tr>
                            <tr>
                                <td> 8</td>
                                <td class="name"><img src="../images/girl3.jpg" alt=""> Aayat Ali Khan </td>
                                <td> Islamabad </td>
                                <td> 30 Feb, 2023 </td>
                                <td>
                                    <p class="status intermediate">Intermediate</p>
                                </td>
                                <td> <strong>30</strong> </td>
                            </tr>
                            <tr>
                                <td> 9</td>
                                <td class="name"><img src="../images/guy6.jpg" alt=""> Cody Chua </td>
                                <td> Dhaka </td>
                                <td> 22 Dec, 2023 </td>
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