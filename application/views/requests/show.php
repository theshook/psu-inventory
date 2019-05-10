<?php
$column = '';

if ($this->session->userdata('role_id') != 4) {
  $column = '<th scope="col" width="20%"></th>';
}

?>

<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Show Request Information</h2>
        </div>
        <div class="card-body">
          <p>Department: <strong><?= $request[0]->depart_title ?></strong></p>
          <div class="form-group row">
            <label for="user_name" class="col-sm-2 col-form-label">Requested By:</label>
            <div class=" col-sm-8">
              <input type="text" name="user_name" placeholder="User id" class="form-control" value="<?= $request[0]->user_lname . ', ' . $request[0]->user_fname . ' ' . $request[0]->user_mname[0] . '.' ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="user_name" class="col-sm-2 col-form-label">Code:</label>
            <div class=" col-sm-8">
              <input type="text" name="user_name" placeholder="User id" class="form-control" value="<?= $request[0]->request_code ?>" disabled>
            </div>
          </div>
          <div class="form-group row" hidden>
            <label for="due_date" class="col-sm-2 col-form-label">Due Date:</label>
            <div class=" col-sm-8">
              <input type="date" name="due_date" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="request_purpose" class="col-sm-2 col-form-label">Purpose:</label>
            <div class=" col-sm-8">
              <input type="text" name="request_purpose" class="form-control" value="<?= $request[0]->request_purpose ?>" disabled />
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col" width="80%">Products</th>
                <th scope="col" width="20%">Quantity</th>
                <th scope="col" width="20%" colspan="2">Status</th>
                <?= $column ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($request_items as $ri) : ?>
                <tr>
                  <th scope="row"><?= $ri->pro_title . ' (' . $ri->unit_name . ')' ?></th>
                  <td><?= $ri->ri_quantity ?></td>
                  <td><?= $ri->ri_status ?></td>
                  <?php if ($this->session->userdata('role_id') != 4) : ?>
                    <?php if ($ri->ri_status != 'Approved') : ?>
                      <td>
                      <a href="<?= base_url() ?>requests/approve/<?= $request[0]->request_no ?>/<?= $ri->ri_no ?>" onClick="return confirm('Do you want to approve?')" class="btn btn-secondary btn-block">Approve</a>
                      </td>
                      <td>
                        <a href="<?= base_url() ?>requests/deny/<?= $request[0]->request_no ?>/<?= $ri->ri_no ?>" onClick="return confirm('Do you want to deny?')" class="btn btn-warning btn-block">Deny</a>
                      </td>
                    <?php endif; ?>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <?php if ($this->session->userdata('role_id') == 1) : ?>
            <div class="form-group row">
              <div class="col-sm-2">
                <a href="<?= base_url() ?>requests/edit/<?= $request[0]->request_no ?>" class="btn btn-info btn-block">Edit</a>
              </div>
              <div class="col-sm-2">
                <a href="<?= base_url() ?>requests/soft_delete/<?= $request[0]->request_no ?>" onClick="return confirm('Do you want to delete?')" class="btn btn-danger btn-block">Delete</a>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>