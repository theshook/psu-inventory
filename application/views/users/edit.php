<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Edit User Information</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('users/update/' . $user[0]->user_no); ?>
          <div class="form-group">
            <label>User Id</label>
            <input type="text" name="user_id" placeholder="User id" class="form-control <?= (form_error('user_id') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_id ?>">
            <div class="invalid-feedback"><?= form_error('user_id'); ?></div>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="user_lname" placeholder="Last name" class="form-control  <?= (form_error('user_lname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_lname ?>">
            <div class="invalid-feedback"><?= form_error('user_lname'); ?></div>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="user_fname" placeholder="Last name" class="form-control  <?= (form_error('user_fname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_fname ?>">
            <div class="invalid-feedback"><?= form_error('user_fname'); ?></div>
          </div>
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="user_mname" placeholder="Middle name" class="form-control  <?= (form_error('user_mname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_mname ?>">
            <div class="invalid-feedback"><?= form_error('user_mname'); ?></div>
          </div>
          <div class="form-group">
            <label>Department</label>
            <select name="depart" class="form-control">
              <?php foreach ($departs as $depart) : ?>
                <option value="<?= $depart->depart_no ?>" <?= ($user[0]->depart_no == $depart->depart_no) ? 'selected' : '' ?>>
                  <?= $depart->depart_code ?> - <?= $depart->depart_title ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Employment Start</label>
            <input type="date" name="employ_start" class="form-control <?= (form_error('employ_start') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_start ?>">
            <div class="invalid-feedback"><?= form_error('employ_start'); ?></div>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="present" class="custom-control-input" id="present" value="1" <?= ($user[0]->employ_end == '') ? "checked" : '' ?>>
            <label class="custom-control-label" for="present">Present</label>
          </div>
          <div class="form-group" id="employ_end" style="<?= ($user[0]->employ_end == '') ? "display: none" : '' ?>">
            <label>Employment end</label>
            <input type="date" name="employ_end" class="form-control <?= (form_error('employ_end') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_end ?>">
            <div class="invalid-feedback"><?= form_error('employ_end'); ?></div>
          </div>
          <div class="form-group" id="employ_end">
            <label>Rate</label>
            <input type="number" name="employ_rate" class="form-control <?= (form_error('employ_rate') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_rate ?>">
            <div class="invalid-feedback"><?= form_error('employ_rate'); ?></div>
          </div>
          <div class="form-group">
            <input type="submit" value="Update" class="btn btn-primary">
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#present').click(function() {
      $('#employ_end').toggle(!this.checked);
    });
  });
</script>