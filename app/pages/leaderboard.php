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
    <link href="https://fonts.cdnfonts.com/css/public-pixel" rel="stylesheet">
                
</head>

<body style='background-image: url("../images/space-bg1.jpg")';>
    <div>
        <?php include ('navbar.php'); ?>
    </div>
    <div class="container-fluid">
        <div>
            <div class="table" id="leaderboard">
                <p style="font-family: 'Public Pixel', sans-serif; font-size :50px; color: white; text-align:center; padding:10px;">Leaderboard</p>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> Ranking </th>
                                <th> Name </th>
                                <th> Level </th>
                                <th> Number of Points </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(u, index) in users">
                                <td><strong> {{ getRank(index) }} </strong></td>
                                <td> <img :src="'../images/profile' + getRank(index) + '.jpg'" alt="">{{ u.username }}</td>
                                <td>
                                    <p class="status expert" v-if="getLevel(u.points) == 'Coding Expert'">Coding Expert</p>
                                    <p class="status whiz" v-if="getLevel(u.points) == 'Tech Whiz'">Tech Whiz</p>
                                    <p class="status proficient" v-if="getLevel(u.points) == 'Proficient Coder'">Proficient Coder</p>
                                    <p class="status intermediate" v-if="getLevel(u.points) == 'Intermediate'">Intermediate</p>
                                    <p class="status beginner" v-if="getLevel(u.points) == 'Beginner'">Beginner</p>
                                </td>
                                <td> <strong>{{ u.points }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        
    </div>
    <script>
        const leaderboard = Vue.createApp({
            data() {
                return {
                    users: [],
                }
            },
            created() {
                this.getUsers();
            },
            methods: {
                getUsers(){
                    let url = "../../server/api/users.php";

                    axios.get(url)
                    .then(r => {
                        this.users = r.data;
                        // sort highest - lowest
                        this.users = r.data.sort(function(a, b){return b.points-a.points});
                    })
                },
                getRank(index) {
                    return index +1;
                },
                getLevel(points) {
                    if (points > 5000) {
                        return "Coding Expert";
                    } else if (points > 4000) {
                        return "Tech Whiz";
                    } else if (points > 2000) {
                        return "Proficient Coder";
                    } else if (points > 1000) {
                        return "Intermediate";
                    } else if (points >= 0) {
                        return "Beginner";
                    }
                }
            }

        })

        const vm = leaderboard.mount("#leaderboard");
        
    </script>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>