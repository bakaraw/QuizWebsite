<!-- Enhanced Modern Login Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center w-100" id="LoginModalLabel   ">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                    </div>
                    <div class="mb-4">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="login" class="btn btn-primary w-100">Log In</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
               
    <p class="text-muted">Don't have an account? <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalSignup">Sign up</a></p>

            </div>
        </div>
    </div>
</div>
