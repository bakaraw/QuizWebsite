<?php
if (!isset($count)) {
    $count = 1;
}
?>
<div>
    <form action="" method="get" id="questionform<?php echo $count; ?>">
        <div class="shadow bg-black border border-light p-3 rounded-4 mt-5" style="--bs-bg-opacity: .25; --bs-border-opacity: .2;">

            <!-- select option element (quiztype) -->
            <div class="input-group mb-3">
                <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                <select onchange="changeQuizType<?php echo $count; ?>()" class="form-select bg-dark text-light border-light" id="questiontype<?php echo $count; ?>" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype<?php echo $count; ?>">
                    <option selected value="iden">Identification</option>
                    <option value="mcq">Multiple Choice Question</option>
                    <option value="tof">True or False</option>
                </select>

            </div>

            <!-- for question text area -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label text-light" style="--bs-text-opacity: .7;">Question:</label>
                <textarea eype="text" class="form-control bg-dark text-light border-light" id="exampleFormControlTextarea1" rows="3" style="--bs-border-opacity: .2;" name="question<?php echo $count; ?>" require></textarea>
            </div>

            <!-- changing div based on the quiz type -->
            <div id="questiontype_gui<?php echo $count; ?>">
                <input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" require>
            </div>

            <!-- for the save and delete button -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button class="btn btn-warning text-dark border-dark btn-md" type="button" name="save-btn<?php echo $count; ?>" id="save-btn<?php echo $count; ?>">Save</button>
                <button class="btn btn-danger bi bi-trash btn-md" type="button">
                    <img src="assets/img/icons/trash-fill.svg" style="fill: white;">
                </button>
            </div>
        </div>
    </form>
    <script>
        // kailangan ni na html para dynamic ng webpage depende sa unsa ang gi select na quiztype
        // html for identification


        const identHtml<?php echo $count; ?> = [
            "<input class=\"form-control bg-dark text-light border-light\" type=\"text\" placeholder=\"Answer\" aria-label=\"default input example\" style=\"--bs-border-opacity: .2;\">"
        ];

        //html for mcq
        const mcqHtml<?php echo $count; ?> = [
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
        const tofHtml<?php echo $count; ?> = [
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


        function changeQuizType<?php echo $count; ?>() {
            var selectElement = document.getElementById("questiontype" + <?php echo $count; ?>);
            var selectedValue = selectElement.value;
            var elementToChange = document.getElementById("questiontype_gui" + <?php echo $count; ?>);

            switch (selectedValue) {
                case "iden":
                    elementToChange.innerHTML = strCat(identHtml<?php echo $count; ?>);
                    break;
                case "mcq":
                    elementToChange.innerHTML = strCat(mcqHtml<?php echo $count; ?>);
                    break;
                case "tof":
                    elementToChange.innerHTML = strCat(tofHtml<?php echo $count; ?>);
                    break;
                default:
                    elementToChange.innerHTML = "<p class=\"text-light\">Something went wrong</p>";
            }
            return false;
        }

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
    </script>
</div>