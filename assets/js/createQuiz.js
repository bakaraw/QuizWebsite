const idenHtml = [
    "<div class=\"form-floating bg-dark\">",
    "<textarea class=\"form-control bg-dark text-light border-light\" placeholder=\"Leave a comment here\" id=\"floatingTextarea2\" style=\"height: 100px; --bs-border-opacity: .2;\"></textarea>",
    "<label class=\"text-light\" for=\"floatingTextarea2\">Question</label></div>"
];


function changeQuizType() {
    var selectElement = document.getElementById("questiontype");
    var selectedValue = selectElement.value;
    var elementToChange = document.getElementById("questiontype_gui");

    switch (selectedValue) {
        case "iden":
            elementToChange.innerHTML = idenHtml[0] + idenHtml[1] + idenHtml[2];
            break;
        case "mcq":
            elementToChange.innerHTML = "Content for option 2";
            break;
        case "tof":
            elementToChange.innerHTML = "Content for option 3";
            break;
        default:
            elementToChange.innerHTML = "Default content";
    }
    return false;
}



