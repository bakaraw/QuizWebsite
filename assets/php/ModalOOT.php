<!-- modaloot -->
<div class="modal fade" id="unclosableModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Out of tab for too long</h1>
            </div>
            <div class="modal-body">
                You have been kicked out
            </div>
            <div class="modal-footer">
                <form method="post">
                    <input type="submit" class="btn btn-primary" name="kick-out-btn" id="kick-out-btn" value="Omki :(" onclick="redirectToQuizList();">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToQuizList() {
        // Redirect to List.php
        window.location.href = 'List.php';
    }
</script>
