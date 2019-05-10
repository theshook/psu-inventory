<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">New Account for: <?= $user[0]->user_lname . ', ' . $user[0]->user_fname . ' ' . $user[0]->user_mname ?></h2>
        </div>
        <div class="card-body">
          <p>ID: <strong><?= $user[0]->user_id ?></strong> | Department: <strong><?= $user[0]->depart_title ?></strong></p>
          <?= form_open('userslogin/' . $action . '/' . $user[0]->user_no); ?>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="login_name" placeholder="Username" class="form-control <?= (form_error('login_name') != false) ? 'is-invalid' : '' ?>" <?php if (!empty($user_login)) : ?> value="<?= $user_login[0]->login_name ?>" disabled <?php endif; ?>>
            <div class="invalid-feedback"><?= form_error('login_name'); ?></div>
          </div>
          <?php if (!empty($user_login)) : ?>
            <div class="form-group">
              <label>Old Password</label>
              <input type="password" name="old_pword" class="form-control  <?= (form_error('old_pword') != false) ? 'is-invalid' : '' ?>">
              <div class="invalid-feedback"><?= form_error('old_pword'); ?></div>
            </div>
          <?php endif; ?>
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
            <label>Access</label>
            <select name="role_id" class="form-control">
              <?php if (!empty($user_login)) : ?>
                <?php foreach ($roles as $role) : ?>
                  <option value="<?= $role->role_id ?>" <?= ($role->role_id == $user_login[0]->role_id) ? 'selected' : '' ?>><?= $role->role_name ?></option>
                <?php endforeach; ?>
              <?php else : ?>
                <?php foreach ($roles as $role) : ?>
                  <option value="<?= $role->role_id ?>"><?= $role->role_name ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="form-group">
            <input type="submit" value="<?= (empty($user_login)) ? 'Create' : 'Update' ?>" class="btn btn-primary">
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>