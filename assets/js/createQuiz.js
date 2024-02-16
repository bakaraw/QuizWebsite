
const identHtml = [
    '<input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" name="answerIden" required>',
    '<div class="invalid-feedback text-danger">',
    'Please enter a question.',
    '</div>'
];

//html for mcq
const mcqHtml= [
    '<p class="text-light" style="--bs-text-opacity: .7;">Input choices then select the answer</p>',
    '<div class="input-group mt-3">',
    '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
    '<input class="form-check-input mt-0" type="radio" value="choiceA" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice A" name="choiceA" required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
    '<input class="form-check-input mt-0" type="radio" value="choiceB" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice B" name="choiceB"  required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
    '<input class="form-check-input mt-0" type="radio" value="choiceC" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice C" name="choiceC" required>',
    '</div>',

    '<div class="input-group mt-3">',
    '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
    '<input class="form-check-input mt-0" type="radio" value="choiceD" aria-label="Radio button for following text input" name="answerMCQ" required>',
    '</div>',
    '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice D" name="choiceD" required>',
    '</div>',
];

// html for true or false
const tofHtml = [
    '<p class="text-light" style="--bs-text-opacity: .7;">Answer:</p>',
    '<div class="form-check form-check-inline">',
    '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio1" value="TRUE" required>',
    '<label class="form-check-label text-light" for="inlineRadio1">True</label>',
    '</div>',

    '<div class="form-check form-check-inline">',
    '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio2" value="FALSE" required>',
    '<label class="form-check-label text-light" for="inlineRadio2">False</label>',
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
    return false;
}