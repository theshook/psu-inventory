<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">View Stock</h2>
        </div>
        <div class="card-body">
          <h3>Status: <?= $release[0]->release_status ?></h3>
		  <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="quantity" min="1" class="form-control  <?= (form_error('release_quantity') != false) ? 'is-invalid' : '' ?>" value="<?= $release[0]->user_lname. ', ' . $release[0]->user_fname. ' '. $release[0]->user_mname ?>" disabled>
            <div class="invalid-feedback"><?= form_error('name'); ?></div>
          </div>
		  <div class="form-group">
            <label>Department</label>
            <input type="text" name="name" id="quantity" min="1" class="form-control  <?= (form_error('release_quantity') != false) ? 'is-invalid' : '' ?>" value="<?= $release[0]->depart_title . ' (' . $release[0]->depart_code . ')' ?>" disabled>
            <div class="invalid-feedback"><?= form_error('name'); ?></div>
          </div>
          <div class="form-group">
            <label>Product</label>
            <select name="pro_no" id="pro_no" class="form-control" disabled>
              <?php foreach ($products as $prod) : ?>
                <option value="<?= $prod->pro_no ?>" <?= ($release[0]->pro_no == $prod->pro_no) ? 'selected' : '' ?>>
                  (<?= $prod->pro_code ?>) <?= $prod->pro_title ?> - <?= $prod->unit_name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="release_quantity" id="quantity" min="1" class="form-control  <?= (form_error('release_quantity') != false) ? 'is-invalid' : '' ?>" value="<?= $release[0]->release_quantity ?>" disabled>
            <div class="invalid-feedback"><?= form_error('release_quantity'); ?></div>
          </div>
          <div class="form-group">
            <label>Date Release</label>
            <input type="date" name="release_date" placeholder="Department Title" class="form-control  <?= (form_error('release_date') != false) ? 'is-invalid' : '' ?>" value="<?= date('Y-m-d', strtotime($release[0]->release_date)) ?>" disabled>
            <div class="invalid-feedback"><?= form_error('release_date'); ?></div>
          </div>
          <div class="form-group">
            <label>Remarks</label>
            <textarea name="release_remark" class="form-control <?= (form_error('release_remark') != false) ? 'is-invalid' : '' ?>" disabled><?= $release[0]->release_remark ?></textarea>
            <div class="invalid-feedback"><?= form_error('release_remark'); ?></div>
          </div>
          <div class="form-group row" <?= ($release[0]->release_status == 'Release') ? 'hidden' : '' ?>>
            <div class="col-sm-2">
              <a href="<?= base_url() ?>release/edit/<?= $release[0]->release_no ?>" class="btn btn-info btn-block">Edit</a>
            </div>
            <div class="col-sm-2">
              <a href="<?= base_url() ?>release/release_product/<?= $release[0]->release_no ?>/<?= $release[0]->pro_no ?>" class="btn btn-secondary btn-block">Release</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>