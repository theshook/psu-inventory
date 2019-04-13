<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Update Inventory</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('inventories/update/' . $inventory[0]->invent_no); ?>
          <div class="form-group">
            <label>Referrence Number</label>
            <input type="text" name="invent_refno" placeholder="Reference Number" class="form-control  <?= (form_error('invent_refno') != false) ? 'is-invalid' : '' ?>" value="<?= $inventory[0]->invent_refno ?>">
            <div class="invalid-feedback"><?= form_error('invent_refno'); ?></div>
          </div>
          <div class="form-group">
            <label>Product</label>
            <select name="pro_no" class="form-control">
              <?php foreach ($products as $prod) : ?>
                <option value="<?= $prod->pro_no ?>" <?= ($inventory[0]->pro_no == $prod->pro_no) ? 'selected' : '' ?>>
                  (<?= $prod->pro_code ?>) <?= $prod->pro_title ?> - <?= $prod->unit_name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="invent_quantity" min="1" class="form-control  <?= (form_error('invent_quantity') != false) ? 'is-invalid' : '' ?>" value="<?= $inventory[0]->invent_quantity ?>">
            <div class="invalid-feedback"><?= form_error('invent_quantity'); ?></div>
          </div>
          <div class="form-group">
            <label>Supplier</label>
            <select name="sup_no" class="form-control">
              <?php foreach ($supplier as $sup) : ?>
                <option value="<?= $sup->sup_no ?>" <?= ($inventory[0]->sup_no == $sup->sup_no) ? 'selected' : '' ?>><?= $sup->sup_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Date Received</label>
            <input type="date" name="invent_date" placeholder="Department Title" class="form-control  <?= (form_error('invent_date') != false) ? 'is-invalid' : '' ?>" value="<?= date('Y-m-d', strtotime($inventory[0]->invent_date)) ?>">
            <div class="invalid-feedback"><?= form_error('invent_date'); ?></div>
          </div>
          <div class="form-group">
            <input type="submit" value=" Update " class="btn btn-primary">
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>