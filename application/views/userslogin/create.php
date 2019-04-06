<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">New Account for: <?= $user[0]->user_lname . ', ' . $user[0]->user_fname . ' ' . $user[0]->user_mname ?></h2>
        </div>
        <div class="card-body">
          <p>ID: <strong><?= $user[0]->user_id ?></strong></p>
          <?= form_open('userslogin/store/' . $user[0]->user_no); ?>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="login_name" placeholder="Username" class="form-control <?= (form_error('login_name') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('login_name'); ?></div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="login_pword" class="form-control  <?= (form_error('login_pword') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('login_pword'); ?></div>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password2" class="form-control  <?= (form_error('password2') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('password2'); ?></div>
          </div>

          <div class="form-group">
            <input type="submit" value="Create" class="btn btn-primary">
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>