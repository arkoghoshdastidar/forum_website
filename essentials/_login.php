<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginLabel">LOGIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="lusername" class="form-label">Username</label>
                        <input type="text" class="form-control" name="lusername" id="lusername"
                            aria-describedby="emailHelp" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="lpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="lpassword" id="lpassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

?>