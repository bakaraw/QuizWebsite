<!-- Modal for Submitting Quiz -->
<div class="modal fade" id="modalSubmitQuiz" tabindex="-1" aria-labelledby="modalSubmitQuizLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSubmitQuizLabel">Submit Quiz</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Would you like to submit this quiz?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('quizForm').submit();">Submit Quiz</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitQuizForm() {
        // Trigger the form submission
        document.getElementById('quizForm').submit();
    }
</script>
