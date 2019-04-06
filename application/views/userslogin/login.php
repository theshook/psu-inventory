<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-8">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">LOGIN</h2>
        </div>
        <div class="card-body">
          <?= form_open('userslogin/login'); ?>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="login_name" placeholder="Username" class="form-control <?= (form_error('login_name') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('login_name'); ?></div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="login_pword" placeholder="Password" class="form-control <?= (form_error('login_pword') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('login_pword'); ?></div>
          </div>
          <div class="form-group">
            <input type="submit" value="Signin" class="btn btn-primary">
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>