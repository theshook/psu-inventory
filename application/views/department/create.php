<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Department Create</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('departments/store'); ?>
          <div class="form-group">
            <label>Department Code</label>
            <input type="text" name="depart_code" placeholder="Department Code" class="form-control <?= (form_error('depart_code') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('depart_code'); ?></div>
          </div>
          <div class="form-group">
            <label>Department Title</label>
            <input type="text" name="depart_title" placeholder="Department Title" class="form-control  <?= (form_error('depart_title') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('depart_title'); ?></div>
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