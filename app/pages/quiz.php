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
    <style>
    #quiz {
        margin: 20px;
    }

    .question-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .question {
        display: none;
    }

    .question.active {
        display: block;
    }

    .options-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .option-button {
        border: 1px solid #007bff;
        border-radius: 8px;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .option-button.selected {
        background-color: #007bff;
        color: #fff;
    }

    #navigation {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    #progress-bar {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .bar-container {
        flex: 1;
        height: 20px;
        background-color: #eee;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar {
        height: 100%;
        background-color: #007bff;
        border-radius: 10px;
        transition: width 0.3s ease;
    }
</style>

</head>

<body>
    <div>
        <?php include('navbar.php'); ?>
    </div>

    <div id="quiz">
        <div class="question-card question" v-for="(qn, index) in quiz" :class="{ active: index === currentIndex }">
            <div>
                <strong>{{ index + 1 }}. {{ qn.question }}</strong>
            </div>
            <div class="mt-2" v-for="(a, optionIndex) in qn.answers">
                <button
                    v-if="a !== null"
                    @click="selectAnswer(index, optionIndex)"
                    :class="{ 'option-button': true, selected: selectedAnswers[index] === optionIndex }"
                >
                    {{ a }}
                </button>
            </div>
        </div>

        <div id="navigation">
            <button @click="prevQuestion" :disabled="currentIndex === 0">Previous</button>
            <button @click="nextQuestionOrSubmit">
                {{ currentIndex === quiz.length - 1 ? 'Submit' : 'Next' }}
            </button>
        </div>

        <div id="progress-bar">
            <span>{{ currentIndex + 1 }} / {{ quiz.length }}</span>
            <div class="bar-container">
                <div class="bar" :style="{ width: (currentIndex + 1) / quiz.length * 100 + '%' }"></div>
            </div>
        </div>

        <div v-if="quizSubmitted" class="result-container">
            <h2>Quiz Result</h2>
            <div v-for="(result, index) in quizResults" :key="index">
                <p>
                    {{ result.question }}: {{ result.correct ? 'Correct' : 'Wrong' }}
                </p>
            </div>
        </div>
    </div>

    <script>
        const quiz = Vue.createApp({
            data() {
                    return {
                        quiz: '',
                        tags: 'javascript', // set the topic
                        limit: 3, // set number of questions
                        currentIndex: 0,
                        selectedAnswers: {}, // Initialize as an empty array
                        quizSubmitted: false,
                        quizResults: [],
                    };
                },
                created() {
                    this.getQuiz();
                },
                methods: {
                    getQuiz() {
                        let url = `https://quizapi.io/api/v1/questions?tags=${this.tags}&limit=${this.limit}&apiKey=mEBcY3BKOXPQCSBfEM8OrDhUPJB43ALBjAKdw9dI`;
                        axios.get(url)
                            .then(r => {
                                this.quiz = r.data;
                            })
                    },

                goToQuestion(index) {
                    this.currentIndex = index;
                },
                nextQuestionOrSubmit() {
                    if (this.currentIndex < this.quiz.length - 1) {
                        this.currentIndex++;
                    } else {
                        this.submitQuiz();
                    }
                },
                prevQuestion() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    }
                },
                selectAnswer(questionIndex, optionIndex) {
                    // Create a new object with the selected answer for the current question
                    this.selectedAnswers = { ...this.selectedAnswers, [questionIndex]: optionIndex };
                },


                submitQuiz() {
                    const numberOfAnswers = Object.keys(this.selectedAnswers).length;
                    console.log(this.selectedAnswers)
                    console.log(this.quiz)

                    if (numberOfAnswers !== this.quiz.length) {
                        console.error('Invalid selectedAnswers array.');
                        return;
                    }

                    const quizResults = [];

                    for (let i = 0; i < this.quiz.length; i++) {
                        const qn = this.quiz[i];
                        const selectedAnswerIndex = this.selectedAnswers[i];

                        if (selectedAnswerIndex === null || selectedAnswerIndex === undefined) {
                            alert('Please answer all questions before submitting.');
                            return;
                        }

                        const isCorrect = Array.isArray(qn.correct_answers)
                            ? qn.correct_answers.includes(selectedAnswerIndex)
                            : selectedAnswerIndex === qn.correct_answers;

                        quizResults.push({
                            question: qn.question,
                            correct: isCorrect,
                        });
                    }

                    this.quizResults = quizResults;
                    this.quizSubmitted = true;
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
