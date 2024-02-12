document.getElementById("create-btn").addEventListener("click", function () {
    
    let quiztitle = document.getElementById("quiztitle").value;
    let errormsg = document.getElementById("message");

    if (quiztitle != ""){
        $.ajax({
            url: "MakeQuiz.php",
            method: "POST",
            data: {quiztitle: quiztitle },
            success: function (response) {
                console.log("Data sent successfully");
            }
        });
    } else {
        errormsg.innerHTML = "Fill-up title" 
        event.preventDefault();
    }
    
     // Now it should log the value set for questionType
});

