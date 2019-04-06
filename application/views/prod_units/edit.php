<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Update Unit Information</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('prod_units/update/' . $unit[0]->unit_no); ?>
          <div class="form-group">
            <label>Unit name</label>
            <input type="text" name="unit_name" placeholder="Unit Name" class="form-control <?= (form_error('unit_name') != false) ? 'is-invalid' : '' ?>" value="<?= $unit[0]->unit_name ?>">
            <div class="invalid-feedback"><?= form_error('unit_name'); ?></div>
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