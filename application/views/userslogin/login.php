<div class="container-fluid mt-5">
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <div align="center">
            <img src="<?= base_url() . 'assets/' ?>img/psu_logo.png" class="img-fluid" height="50%" width="50%">
          </div>
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
            <button type="submit" id="login" class="btn btn-primary">
              <i id="loading" class="fa fa-spinner fa-spin fa-fw" style="display:none"></i>
              <span class="sr-only">Loading...</span>Sign in</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#login').click(function() {
      $('#loading').show();
    });
  });
</script>