<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>


    <div id="quiz">
        <div class="bg-secondary text-light m-1" v-for="(qn, index) in quiz">
            {{ index+1 }}. {{ qn.question }}
            <div class="" v-for="(a, index) in qn.answers">
                <input v-if="a != null" type="checkbox" value="qn.correct_answers[index]">{{ a }}</input>     
            </div>
        </div>
    </div>
    

    <script>
        const quiz = Vue.createApp({
            data() {
                return {
                    quiz: '',
                    tags: 'javascript', // set the topic
                    limit: 10, // set number of questions
                }
            },
            methods: {
                getQuiz() {
                    let url = `https://quizapi.io/api/v1/questions?tags=${this.tags}&limit=${this.limit}&apiKey=mEBcY3BKOXPQCSBfEM8OrDhUPJB43ALBjAKdw9dI`;
                    
                    axios.get(url)
                    .then(r => {
                        this.quiz = r.data;
                    })
                }
            },
            created() {
                this.getQuiz();
            }
        })
        
        const vm = quiz.mount('#quiz');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>