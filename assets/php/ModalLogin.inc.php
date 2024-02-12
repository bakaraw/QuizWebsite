    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Login</h4>
                    <a href="index.php" class="close" aria-label="Close" style="text-decoration: none; display: inline-block; color: inherit; background-color: transparent; border: none; cursor: pointer;">
                    <span aria-hidden="true">&times;</span>
                  </a>
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
                        <button type="submit" name="login" class="btn btn-default">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
