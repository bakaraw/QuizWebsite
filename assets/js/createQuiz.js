
const identHtml = [
    '<input class="form-control" type="text" placeholder="Answer" aria-label="default input example" name="answerIden" required>',
    '<div class="invalid-feedback text-danger">',
    'Please enter a question.',
    '</div>'
];

//html for mcq
const mcqHtml = [
    '<p>Input choices then select the answer</p>',
    '<div class="input-group mt-3">',
    '<div class="input-group-text solid-shadow-orange">',
    '<input class="form-check-input mt-0" type="radio" value="choiceA" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control solid-shadow-orange" aria-label="Text input with radio button" placeholder="Choice A" name="choiceA" required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text solid-shadow-orange">',
    '<input class="form-check-input mt-0" type="radio" value="choiceB" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control solid-shadow-orange" aria-label="Text input with radio button" placeholder="Choice B" name="choiceB"  required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text solid-shadow-orange">',
    '<input class="form-check-input mt-0" type="radio" value="choiceC" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control solid-shadow-orange" aria-label="Text input with radio button"  placeholder="Choice C" name="choiceC" required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text solid-shadow-orange" >',
    '<input class="form-check-input mt-0" type="radio" value="choiceD" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control solid-shadow-orange" aria-label="Text input with radio button"  placeholder="Choice D" name="choiceD" required>',
    '</div>',
];

// html for true or false
const tofHtml = [
    '<p>Answer:</p>',
    '<div class="form-check form-check-inline">',
    '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio1" value="TRUE" required>',
    '<label class="form-check-label" for="inlineRadio1">True</label>',
    '</div>',

    '<div class="form-check form-check-inline">',
    '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio2" value="FALSE" required>',
    '<label class="form-check-label" for="inlineRadio2">False</label>',
    '</div>',
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
        case "IDEN":
            elementToChange.innerHTML = strCat(identHtml);
            break;
        case "MCQ":
            elementToChange.innerHTML = strCat(mcqHtml);
            break;
        case "TOF":
            elementToChange.innerHTML = strCat(tofHtml);
            break;
        default:
            elementToChange.innerHTML = "<p class=\"text-light\">Something went wrong</p>";
    }
    $(document).ready(function () {
        $('html, body').animate({ scrollTop: $(document).height() }, 'fast');
    });
    
    return false;
}

// for form validation (kung dili butngan value ang mga textarea sa form kay mag warning)
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity(forms)) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()


