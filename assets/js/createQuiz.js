// kailangan ni na html para dynamic ng webpage depende sa unsa ang gi select na quiztype
// html for identification
const identHtml = [
    "<input class=\"form-control bg-dark text-light border-light\" type=\"text\" placeholder=\"Answer\" aria-label=\"default input example\" style=\"--bs-border-opacity: .2;\">"
];

//html for mcq
const mcqHtml = [
    "<p class=\"text-light\" style=\"--bs-text-opacity: .7;\">Input choices then select the answer</p>",
    "<div class=\"input-group mt-3\">",
    "<div class=\"input-group-text bg-dark border-light\" style=\"--bs-border-opacity: .2;\">",
    "<input class=\"form-check-input mt-0\" type=\"radio\" value=\"\" aria-label=\"Radio button for following text input\" name=\"answer\">",
    "</div>",
    "<input type=\"text\" class=\"form-control bg-dark border-light text-light\" aria-label=\"Text input with radio button\" style=\"--bs-border-opacity: .2;\" placeholder=\"Choice A\">",
    "</div>",

    "<div class=\"input-group mt-3\">",
    "<div class=\"input-group-text bg-dark border-light\" style=\"--bs-border-opacity: .2;\">",
    "<input class=\"form-check-input mt-0\" type=\"radio\" value=\"\" aria-label=\"Radio button for following text input\" name=\"answer\">",
    "</div>",
    "<input type=\"text\" class=\"form-control bg-dark border-light text-light\" aria-label=\"Text input with radio button\" style=\"--bs-border-opacity: .2;\" placeholder=\"Choice B\">",
    "</div>",

    "<div class=\"input-group mt-3\">",
    "<div class=\"input-group-text bg-dark border-light\" style=\"--bs-border-opacity: .2;\">",
    "<input class=\"form-check-input mt-0\" type=\"radio\" value=\"\" aria-label=\"Radio button for following text input\" name=\"answer\">",
    "</div>",
    "<input type=\"text\" class=\"form-control bg-dark border-light text-light\" aria-label=\"Text input with radio button\" style=\"--bs-border-opacity: .2;\" placeholder=\"Choice C\">",
    "</div>",

    "<div class=\"input-group mt-3\">",
    "<div class=\"input-group-text bg-dark border-light\" style=\"--bs-border-opacity: .2;\">",
    "<input class=\"form-check-input mt-0\" type=\"radio\" value=\"\" aria-label=\"Radio button for following text input\" name=\"answer\">",
    "</div>",
    "<input type=\"text\" class=\"form-control bg-dark border-light text-light\" aria-label=\"Text input with radio button\" style=\"--bs-border-opacity: .2;\" placeholder=\"Choice D\">",
    "</div>",
];

// html for true or false
const tofHtml = [
    "<p class=\"text-light\" style=\"--bs-text-opacity: .7;\">Answer:</p>",
    "<div class=\"form-check form-check-inline\">",
    "<input class=\"form-check-input\" type=\"radio\" name=\"inlineRadioOptions\" id=\"inlineRadio1\" value=\"option1\">",
    "<label class=\"form-check-label text-light\" for=\"inlineRadio1\">True</label>",
    "</div>",

    "<div class=\"form-check form-check-inline\">",
    "<input class=\"form-check-input\" type=\"radio\" name=\"inlineRadioOptions\" id=\"inlineRadio2\" value=\"option2\">",
    "<label class=\"form-check-label text-light\" for=\"inlineRadio2\">False</label>",
    "</div>",
];


function strCat(strArr) {
    let result = "";
    for (let i = 0; i < strArr.length; i++) {
        result += strArr[i];
    }
    return result;
}


function changeQuizType() {
    var selectElement = document.getElementById("questiontype");
    var selectedValue = selectElement.value;
    var elementToChange = document.getElementById("questiontype_gui");

    switch (selectedValue) {
        case "iden":
            elementToChange.innerHTML = strCat(identHtml);
            break;
        case "mcq":
            elementToChange.innerHTML = strCat(mcqHtml);
            break;
        case "tof":
            elementToChange.innerHTML = strCat(tofHtml);
            break;
        default:
            elementToChange.innerHTML = "<p class=\"text-light\">Something went wrong</p>";
    }
    return false;
}


const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// class Question{
//     question;
//     questionType;
//     answer;
//     choiceA;
//     choiceB;
//     choiceC;
//     choiceD;

//     setQuestion(question){
//         this.question = question;
//     }

//     setQuestionType(questionType){
//         this.questionType = questionType;
//     }

//     setAnswer(answer){
//         this.answer = answer;
//     }

//     setChoiceA(choiceA){
//         this.choiceA = choiceA;
//     }

//     setChoiceB(choiceB){
//         this.choiceB = choiceB;
//     }

//     setChoiceC(choiceC){
//         this.choiceC = choiceC;
//     }

//     setChoiceD(choiceD){
//         this.choiceD = choiceD;
//     }

//     getQuestionType(){
//         return this.questionType;
//     }
// }

// // When save button is clicked
// document.getElementById("save-btn").addEventListener("click", function() {
//     // Disable the input elements
//     let question = new Question();
//     let questiontypeVal = document.getElementById("questiontype").value;

//     question.setQuestionType(questiontypeVal);
//     // document.getElementById("questiontype").disabled = true;

//     console.log(question.getQuestionType()); // Now it should log the value set for questionType
// });

document.getElementById("create-btn").addEventListener("click", function () {
    // 
    // Disable the input elements
    let quiztitle = document.getElementById("quiztitle").value;
    let errormsg = document.getElementById("message");

    if (quiztitle != ""){
        $.ajax({
            url: "MakeQuiz.php",
            method: "POST",
            data: {quiztitle: quiztitle },
            success: function (response) {
                console.log("Data sent successfully");
                // window.location.href = "http://localhost/csthings/QuizWebsite/createQuiz.php";
            }
        });
        // redirect page
    } else {
        errormsg.innerHTML = "Fill-up title" 
        console.log('hello');
        event.preventDefault();
    }
    
     // Now it should log the value set for questionType
});


