<!-- ModalUnansweredQ.php -->

<div class="modal fade" id="modalUnansweredQuestions" tabindex="-1" aria-labelledby="UnansweredQuestionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="UnansweredQuestionsModalLabel">Unanswered Questions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-4">Would you like to submit this quiz? You still have unanswered questions.</p>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continue Quiz</button>
                    <button type="button" class="btn btn-danger" onclick="submitWithUnanswered()">Submit Anyway</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitWithUnanswered() {
        // Perform the action you want when the user chooses to submit with unanswered questions
        // For example, you can submit the quiz or perform other actions
        document.getElementById('quiz-form').submit(); // Adjust the form ID accordingly
    }
</script>
