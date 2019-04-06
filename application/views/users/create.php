<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Create new User</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('users/create'); ?>
          <div class="form-group">
            <label>User Id</label>
            <input type="text" name="user_id" placeholder="User id" class="form-control <?= (form_error('user_id') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('user_id'); ?></div>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="user_lname" placeholder="Last name" class="form-control  <?= (form_error('user_lname') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('user_lname'); ?></div>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="user_fname" placeholder="First name" class="form-control  <?= (form_error('user_fname') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('user_fname'); ?></div>
          </div>
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="user_mname" placeholder="Middle name" class="form-control  <?= (form_error('user_mname') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('user_mname'); ?></div>
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