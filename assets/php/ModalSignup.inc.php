<!-- Enhanced Modern Signup Modal -->
<div class="modal fade" id="modalSignup" tabindex="-1" aria-labelledby="SignupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center w-100" id="SignupModalLabel ">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    
                    <div class="mb-4">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p class="text-muted">Already have an account? <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">Log in</a></p>
            </div>
        </div>
    </div>
</div>
