<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Edit Request</h2>
        </div>
        <div class="card-body">
          <p>Department: <strong><?= $request[0]->depart_title ?></strong></p>
          <?= form_open('requests/update/'.$request[0]->request_no); ?>
          <div class="form-group row">
            <label for="user_name" class="col-sm-2 col-form-label">Requested By:</label>
            <div class=" col-sm-8">
              <input type="text" name="user_name" placeholder="User id" class="form-control" value="<?= $this->session->userdata('user_lname') . ', ' . $this->session->userdata('user_fname') . ' ' . $this->session->userdata('user_mname')[0] . '.' ?>" disabled>
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
              <input type="text" name="request_purpose" class="form-control <?= (form_error('request_purpose') != false) ? 'is-invalid' : '' ?>" value="<?= $request[0]->request_purpose ?>" />
              <div class="invalid-feedback"><?= form_error('request_purpose'); ?></div>
            </div>
          </div>
          <div class="form-group row">
            <label for="request_purpose" class="col-sm-2 col-form-label">Code:</label>
            <div class=" col-sm-8">
              <input type="text" name="request_code" class="form-control <?= (form_error('request_code') != false) ? 'is-invalid' : '' ?>" value="<?= $request[0]->request_code ?>" />
              <div class="invalid-feedback"><?= form_error('request_code'); ?></div>
            </div>
          </div>
          <table class="table table-striped table-hover" id="tb">
            <thead>
              <tr>
                <th scope="col" width="80%">Products</th>
                <th scope="col" width="20%">Quantity</th>
                <th scope="col"><a href="javascript:void(0);"  id="add_field" class="add_button" title="Add field">
                      <i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i>
                    </a></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($request_items as $key => $ri): ?>
                <tr>
                  <th scope="row" width="80%">
                    <select name="prod_no[]" id="products[]" class="form-control">
                      <?php foreach ($products as $product) : ?>
                        <option value="<?= $product->pro_no ?>" <?= ($product->pro_no == $ri->pro_no) ? 'selected' : '' ?>>
                          <?= $product->pro_title ?> - (<?= $product->unit_name ?>)
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </th>
                  <td width="20%">
                    <input type="number" name="ri_quantity[]" value="<?= $ri->ri_quantity ?>" min="1" class="form-control <?= (form_error('ri_quantity[]') != false) ? 'is-invalid' : '' ?>" />
                  </td>
                  <td>
                    <a href="javascript:void(0);"  id="remove_field" class="remove" title="Remove field">
                      <i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="form-group">
            <div class="col-sm-2">
              <input type="submit" value="Update" class="btn btn-primary btn-block">
            </div>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#add_field').on('click', function() {
        var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
        data.find("input").val('');
    });
    $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
         console.log(trIndex)
            if(trIndex>0) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
  });
</script>