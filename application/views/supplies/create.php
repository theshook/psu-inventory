<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">New Supply</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('supplies/store'); ?>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="sup_name" placeholder="Supply Name" class="form-control <?= (form_error('sup_name') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('sup_name'); ?></div>
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