<div class="modal fade" id="modalSignup" tabindex="-1" role="dialog" aria-labelledby="SignupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="username" name="username" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="username">Username</label>
                    </div>

                    <div class="md-form mb-4">
                        <i class="fas fa-lock prefix grey-text"></i>
                        <input type="password" id="pass" name="pass" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="pass">Password</label>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-default">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>