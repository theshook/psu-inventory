<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">New Request</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('requests/store'); ?>
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
              <input type="text" name="request_purpose" class="form-control <?= (form_error('request_purpose') != false) ? 'is-invalid' : '' ?>" />
              <div class="invalid-feedback"><?= form_error('request_purpose'); ?></div>
            </div>
          </div>
          <div class="field_wrapper">
            <div class="form-group row">
              <label for="products[]" class="col-sm-2 col-form-label">Products:</label>
              <div class="col-sm-6">
                <select name="prod_no[]" id="products[]" class="form-control">
                  <?php foreach ($products as $product) : ?>
                    <option value="<?= $product->pro_no ?>">
                      <?= $product->pro_title ?> - (<?= $product->unit_name ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-2">
                <input type="number" name="ri_quantity[]" value="1" min="1" class="form-control <?= (form_error('ri_quantity') != false) ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback"><?= form_error('ri_quantity'); ?></div>
              </div>
              <div class="col-sm-1">
                <label for="products[]" class="col-form-label"><a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a></label>
              </div>
            </div>
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
<script>
  $(document).ready(function() {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `
    <div class="form-group row">
              <label for="products[]" class="col-sm-2 col-form-label">Products: </label>
              <div class="col-sm-6">
                <select name="prod_no[]" id="products[]" class="form-control">
                  <?php foreach ($products as $product) : ?>
                                      <option value="<?= $product->pro_no ?>">
                                        <?= $product->pro_title ?> - (<?= $product->unit_name ?>)
                                      </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-2">
                <input type="text" name="ri_quantity[]" value="1" class="form-control <?= (form_error('ri_quantity') != false) ? 'is-invalid' : '' ?>" min="1" />
                <div class="invalid-feedback"><?= form_error('ri_quantity'); ?></div>
              </div>
              <div class="col-sm-1">
                <label for="products[]" class="col-form-label"><a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></i></a></label>
              </div>
            </div>
    `; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
      //Check maximum number of input fields
      if (x < maxField) {
        x++; //Increment field counter
        $(wrapper).append(fieldHTML); //Add field html
      }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parents('.form-row').remove(); //Remove field html
      x--; //Decrement field counter
    });
  });
</script>