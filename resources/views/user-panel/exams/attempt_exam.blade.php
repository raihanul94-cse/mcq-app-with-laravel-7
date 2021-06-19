@extends('layouts.master')

@section('contents')
<div class="content-header">

</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid exam">
        
        <div class="counters">
            <p>Question: <span class="js-question-counter">1</span> / <span class="js-question-total">10</span></p>
            <p>Score: <span class="js-score-counter">0</span></p>
            <p> <i class="fa fa-stopwatch"> </i> <span class="js-question-time-counter">0:00</span></p>
            <p><i class="fa fa-stopwatch"></i> <span class="js-total-time-counter">0:00</span></p>
        </div>
        <div class="js-intro">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Exam Description
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl>
                                <dt>Instractions</dt>
                                <ul>
                                    <li>For each question you will have on average 10 minutes.</li>
                                    <li>You will have total 30 minutes for this exam. Total time is the summation of all
                                        individual time for each question.</li>
                                    <li>If you failed to give answer of any question before time limit. The system will
                                        move
                                        forward automatically, and you will not have any score for the question.</li>
                                    <li>If you move forward you cannot go backward.</li>
                                    <li>And Finally, You should not reload the page while attempting the exam. If you
                                        reload
                                        the page everything will be reset.</li>
                                </ul>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Exam Information
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <dl class="float-left">
                                        <dt class="js-exam-title">No title available</dt>
                                        <dt>Total Questions: <span class="js-exam-total-questions">0</span></dt>
                                        <dt>Total Times: <span class="js-exam-total-times">0</span></dt>
                                        <dt>Average Time: <span class="js-exam-avarage-time">0</span></dt>
                                        <dt>Total Marks: <span class="js-exam-total-marks">0</span></dt>
                                        <dt>Exam Category: <span class="js-exam-category">No category available</span></dt>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <dl class="float-right">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th style="width: 150px;">Key</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tr style="text-align: center;">
                                                <td>Prev. Score</td>
                                                <td id="prev_score">{{ $examAttempt ? $examAttempt->score : 0}}</td>
                                            </tr>
                                            <tr style="text-align: center;">
                                                <td>Attempt</td>
                                                <td id="attempts">{{ $examAttempt ? $examAttempt->attempts : 0}}</td>
                                            </tr>
                                        </table>
                                    </dl>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center"><button
                                    class="btn btn-primary centered js-intro-submit"> <i
                                        class="fa fa-hourglass-start "></i> Start Exam</button></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="quizform js-question centered"></div>
                <div class="quizform js-feedback centered"></div>
                <div class="quizform js-evaluation centered"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.counters {
    background: #5fbcda;
    display: flex;
    justify-content: space-evenly;
    padding-top: 17px;
    font-family: 'Lato', sans-serif;
    font-size: 18px;
}


.quizdiv {
    align-items: center;
    display: flex;
    height: 20em;
    justify-content: center;
    margin: 1.5em 0;
}

.quizform {
    background: white;
    border-radius: 2px;
    border: 1px solid #e3e3e3;
    padding: 1em 2em;
    width: 100%;
}

.controls {
    display: flex;
    justify-content: center;
}

@media (max-width: 399px) {
    .quizform {
        width: 100%;
    }
}

/* Ipad portrait */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
    .counters {
        margin-bottom: 10em;
    }
}

/* iPad landscape */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
    .counters {
        margin-bottom: 3em;
    }
}

/* iPhone 6, 7, & 8 Plus in portrait */
@media only screen and (min-device-width: 414px) and (max-device-height: 736px) and (orientation : portrait) {
    .counters {
        margin-bottom: 3em;
    }

    .quizform {
        width: 65%;
    }
}

/* iPhone 6, 7, & 8 Plus in landscape */
@media only screen and (min-device-width : 414px) and (max-device-width : 736px) and (orientation : landscape) {
    .quizdiv {
        margin: 0;
    }

    .quizform {
        margin-top: 2em;
        width: 75%;
    }
}

/* iPhone 5 & 5s in portrait*/
@media only screen and (min-device-width : 320px) and (max-device-width : 568px) and (orientation : portrait) {
    .counters {
        margin-bottom: 3em;
    }
}

/* iPhone 2G, 3G, 4, 4S */
@media only screen and (min-device-width : 320px) and (max-device-width : 413px) and (orientation : portrait) {
    .counters {
        margin-bottom: 1em;
    }

    .quizform {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 0;
        width: 100%;
    }
}
</style>
<script>
const DB = [];
const state = {marks: 0, title: "", questions: 0, times: 0, avg_time: 0, category: ""};
let examTimeCounter;
let questionTimeCounter;
let remainingExamTime;
let count = 0;
let spanCount = 0;
let score = 0;

$(document).ready( function () {
    // get exam questions form database via laravel path
    $.ajax({
        type: "GET",
        url: "/get-questions/{{ $id }}",
        success: function (response) {
            var exam = JSON.parse(response);
            state.title = exam.title;
            state.category = exam.category.title;
            $.each(exam.questions, function (key, value){
                state.marks += parseInt(value.questionWeight);
                state.times += parseInt(value.timeLimit) * 60;
                DB.push({ question: value.question, options: value.options, correctOption: value.correctOption, weight: value.questionWeight, timeLimit: value.timeLimit });
                $('.js-question-total').text(Object.keys(DB).length);
            });
            state.questions = Object.keys(DB).length;
            state.avg_time = state.times / state.questions;
            renderExamInfo();
        }
    });
});

// render exam front page
const renderExamInfo = () => {
    $(".js-exam-title").text(state.title);
    $(".js-exam-total-questions").text(state.questions);
    $(".js-exam-total-times").text(state.times/60);
    $(".js-exam-avarage-time").text(state.avg_time/60);
    $(".js-exam-total-marks").text(state.marks);
    $(".js-exam-category").text(state.category);
}

// set up initial Intro
function renderIntro() {
    $(".js-intro").show();
    $('.counters').hide();
    $(".js-question").hide();
    $(".js-feedback").hide();
    $(".js-evaluation").hide();
}

// start exam timer...
const startExamTimer = (limit) => {
    limit = limit * 60;
    const timer = () => {
        const minutes = Math.floor(limit / 60);
        let seconds = limit % 60;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        $('.js-total-time-counter').text(`${minutes}:${seconds}`);
        limit--;
        limit = limit < 0 ? timeout() : limit;
        remainingExamTime = limit;
    }

    const timeout = () =>{
        clearInterval(examTimeCounter);
        $(".js-question").hide();
        $(".js-feedback").hide();
        $(".js-evaluation").show();
        renderScore();
        return 0;
    }

    examTimeCounter = setInterval(timer, 1000);
}

// start question timer...
const startQuestionTimer = (limit) => {
    limit = limit * 60;
    const timer = () => {
        const minutes = Math.floor(limit / 60);
        let seconds = limit % 60;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        $('.js-question-time-counter').text(`${minutes}:${seconds}`);
        limit--;
        limit = limit < 0 ? timeout() : limit;
    }
    
    const timeout = () =>{
        clearInterval(questionTimeCounter);
        return 0;
    }

    questionTimeCounter = setInterval(timer, 1000);
}


// bind start quiz button
function renderQuestion() {
    $(".js-intro-submit").on("click", event => {
        event.preventDefault();
        renderQuestionForm();
        // starting the exam timer
        startExamTimer(state.times/60);
    });
}

// updates DOM element with spanCount
function increaseSpanCount() {
    spanCount++;
    $(".js-question-counter").text(spanCount);
}

// create a reusable renderQuestion function
function renderQuestionForm() {
    increaseSpanCount();
    showOnlyQuestionDiv();
    $(".js-question").html(`
    <form id='form'>
    <fieldset>
    <legend><h2>${DB[count].question}</h2></legend>
    <div class='css-answers'>
		<input id='answer1' type="radio" name='answer' value='a' required>
		<label for='answer1'>${DB[count].options['a']}</label>
    </div>
    <div class='css-answers'>
    <input id='answer2' type="radio" name='answer' value='b' required>
		<label for='answer2'>${DB[count].options['b']}</label>
    </div>
    <div class='css-answers'>
    <input id='answer3' type="radio" name='answer' value='c' required>
		<label for='answer3'>${DB[count].options['c']}</label>
    </div>
    <div class='css-answers'>
    <input id='answer4' type="radio" name='answer' value='d' required>
		<label for='answer4'>${DB[count].options['d']}</label>
    </div>
    </fieldset>
    <div class="controls">
    <button class='btn btn-success js-question-submit'>Submit</button>
    </div>
    </form>`);

    startQuestionTimer(DB[count].timeLimit);
}
// show only the question div
function showOnlyQuestionDiv() {
    $(".js-intro").hide();
    $(".js-feedback").hide();
    $(".js-question").show();
    $('.counters').show();
}

// set event listener to submit the question; evaluate answer for correctness, call to render feedback
function submitQuestion() {
    $(".js-question").on("submit", event => {
        event.preventDefault();
        clearInterval(questionTimeCounter);
        clearInterval(examTimeCounter);
        const value = fetchRadioValue(event);
        const answerIsCorrect = checkAnswer(value);
        const feedbackText = renderFeedbackText(answerIsCorrect);
        renderFeedback(feedbackText);
    });
}

// fetches the text value of the radio button
function fetchRadioValue(event) {
    let checkedRadioButton = $(event.currentTarget)
        .find("input:checked")
        .val();
    return checkedRadioButton;
}

// radio value is equal to correct answer in database
function checkAnswer(answer) {
    return answer === `${DB[count].correctOption}`;
}

// if statement returns rendered correct or incorrect answer text
function renderFeedbackText(correctOption) {
    let responseMsg = "";
    if (correctOption) {
        responseMsg = `<h2>Correct</h2>
                <p>On to the next.</p>
                <div class="controls">
                <button class='btn btn-success js-feedback-submit'>Next</button>
                </div>`;
        increaseScoreCount();
    } else {
        responseMsg = `<h2>Ouch, this is not right</h2>
                <p>The correct answer is: '${DB[count].options[DB[count].correctOption]}'</p>
                <div class="controls">
                <button class='btn btn-success js-feedback-submit'>Next</button>
                </div>`;
    }
    return responseMsg;
}

// increases score on correct answer
function increaseScoreCount() {
    score += parseInt(DB[count].weight);
    updateDomScore(count);
}

// updates DOM element with score
function updateDomScore(count) {
    $(".js-score-counter").text(score);
}

// function inserts correct/incorrect text into HTML
function renderFeedback(response) {
    $(".js-question").hide();
    $(".js-feedback")
        .show()
        .html(response);
    increaseDbCount();
}

// increases DB question index for renderQuestion
function increaseDbCount() {
    count++;
}

// feedback div button calls eval function
function submitFeedback() {
    $(".js-feedback").on("click", ".js-feedback-submit", () => {
        ifMaxQuestionIsReached();
    });
}

// evaluates if end of questions are reached. if so, call eval. if not, call renderquestionform
function ifMaxQuestionIsReached() {
    if (count === Object.keys(DB).length) {
        // Stop the total time countdown.....
        showEval();
        renderScore();
    } else {
        renderQuestionForm();
        startExamTimer(remainingExamTime/60);
    }
}

// show eval div
function showEval() {
    $(".js-feedback").hide();
    $(".js-evaluation").show();
}

// renders eval text & final score
function renderScore() {
    clearInterval(examTimeCounter);
    if(((score/state.marks)*100) > 60){
        $(".js-evaluation").html(`
        <h2>You did it!</h2>
        <h3>Your final score is ${score}.</h3>
        <h3>That is ${score} out of ${state.marks}.</h3>
        <div class="controls">
        <button class='btn btn-success js-button-reload'>Play again</button>
        </div>
        `);
    }else{
        $(".js-evaluation").html(`
        <h2>Aww! Try again for good score..</h2>
        <h3>Your final score is ${score}.</h3>
        <h3>That is ${score} out of ${state.marks}.</h3>
        <div class="controls">
        <button class='btn btn-success js-button-reload'>Play again</button>
        </div>
        `);
    }

    $.ajax({
        type: "GET",
        url: `/update-score/{{ $id }}/${score}`,
        success: function (response) {
            $("#prev_score").text(response.score);
            $("#attempts").text(response.attempts);
        }
    });
}

//  binds reload functions to final eval div button
function reload() {
    $(".js-evaluation").on("click", ".js-button-reload", () => {
        resetAll();
        renderIntro();
    });
}

// resets all counters
function resetAll() {
    count = 0;
    spanCount = 0;
    score = 0;
    clearInterval(examTimeCounter);
    $('.js-question-time-counter').text("0:00");
    $('.js-total-time-counter').text("0:00");
    $(".js-question-counter").text(0);
    $(".js-score-counter").text(0);
}

function startApp() {
    renderIntro();
    renderQuestion();
    submitQuestion();
    submitFeedback();
    reload();
}

$(startApp);
</script>
@endsection