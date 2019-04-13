<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">New Product</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('products/store'); ?>
          <div class="form-group">
            <label>Code</label>
            <input type="text" name="pro_code" placeholder="Product Code" class="form-control <?= (form_error('pro_code') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('pro_code'); ?></div>
          </div>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="pro_title" placeholder="Product Title" class="form-control <?= (form_error('pro_title') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('pro_title'); ?></div>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="number" name="pro_price" placeholder="Product Price" class="form-control <?= (form_error('pro_price') != false) ? 'is-invalid' : '' ?>" autofocus>
            <div class="invalid-feedback"><?= form_error('pro_price'); ?></div>
          </div>
          <div class="form-group">
            <label>Unit</label>
            <select name="unit_no" class="form-control">
              <?php foreach ($units as $unit) : ?>
                <option value="<?= $unit->unit_no ?>"><?= $unit->unit_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select name="cat_no" class="form-control">
              <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->cat_no ?>"><?= $category->cat_name ?></option>
              <?php endforeach; ?>
            </select>
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