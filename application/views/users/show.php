<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="text-monospace">
            <h2>USER INFORMATION</h2>
          </div>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <div class="form-group">
            <label>User Id</label>
            <input type="text" name="user_id" placeholder="User id" class="form-control <?= (form_error('user_id') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_id ?>" disabled>
            <div class="invalid-feedback"><?= form_error('user_id'); ?></div>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="user_lname" placeholder="Last name" class="form-control  <?= (form_error('user_lname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_lname ?>" disabled>
            <div class="invalid-feedback"><?= form_error('user_lname'); ?></div>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="user_fname" placeholder="Last name" class="form-control  <?= (form_error('user_fname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_fname ?>" disabled>
            <div class="invalid-feedback"><?= form_error('user_fname'); ?></div>
          </div>
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="user_mname" placeholder="Middle name" class="form-control  <?= (form_error('user_mname') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->user_mname ?>" disabled>
            <div class="invalid-feedback"><?= form_error('user_mname'); ?></div>
          </div>
          <div class="form-group">
            <label>Department</label>
            <select name="depart" class="form-control" disabled>
              <?php foreach ($departs as $depart) : ?>
                <option value="<?= $depart->depart_no ?>" <?= ($user[0]->depart_no == $depart->depart_no) ? 'selected' : '' ?>>
                  <?= $depart->depart_code ?> - <?= $depart->depart_title ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Employment Start</label>
            <input type="date" name="employ_start" class="form-control <?= (form_error('employ_start') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_start ?>" disabled>
            <div class="invalid-feedback"><?= form_error('employ_start'); ?></div>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="present" class="custom-control-input" id="present" value="1" <?= ($user[0]->employ_end == '') ? "checked" : '' ?> disabled>
            <label class="custom-control-label" for="present">Present</label>
          </div>
          <div class="form-group" id="employ_end" style="<?= ($user[0]->employ_end == '') ? "display: none" : '' ?>">
            <label>Employment end</label>
            <input type="date" name="employ_end" class="form-control <?= (form_error('employ_end') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_end ?>" disabled>
            <div class="invalid-feedback"><?= form_error('employ_end'); ?></div>
          </div>
          <div class="form-group" id="employ_end">
            <label>Rate</label>
            <input type="number" name="employ_rate" class="form-control <?= (form_error('employ_rate') != false) ? 'is-invalid' : '' ?>" value="<?= $user[0]->employ_rate ?>" disabled>
            <div class="invalid-feedback"><?= form_error('employ_rate'); ?></div>
          </div>
          <div class="form-row">
            <div class="col-sm-2">
              <a href="<?= base_url() . 'users/update/' . $user[0]->user_no ?> " class="btn btn-primary btn-block">Update</a>
            </div>
            <div class="col-sm-2">
              <a href="<?= base_url() . 'users/delete/' . $user[0]->user_no ?> " class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
          </div>
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