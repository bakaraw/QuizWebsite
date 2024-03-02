<!-- assets/php/ModalStartQ.php -->
<!-- Modal for starting the quiz -->
<div class="modal fade" id="modalStartQuiz" tabindex="-1" role="dialog" aria-labelledby="modalStartQuizLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStartQuizLabel">Start Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Would you like to start this quiz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="startQuizBtn">Start Quiz</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener for modal close
        $('#modalStartQuiz').on('hidden.bs.modal', function () {
            // Clear the active class when the modal is closed
            document.querySelector('.card.quiz-card.active').classList.remove('active');
        });

        // Add event listener for the "Start Quiz" button
        document.getElementById('startQuizBtn').addEventListener('click', function () {
            // Get the quiz code from the clicked card
            var quizCode = document.querySelector('.card.quiz-card.active').getAttribute('data-quiz-code');
            
            // Redirect the user to the answerQuiz.php page with the quiz code
            window.location.href = 'answerQuiz.php?code_for_quiz=' + quizCode;
        });
    });
</script>
