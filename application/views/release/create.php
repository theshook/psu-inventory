<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Release Stock</h2>
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <?= form_open('release/store'); ?>
          <div class="form-group">
            <label>Product</label>
            <select name="pro_no" id="pro_no" class="form-control">
              <?php foreach ($products as $prod) : ?>
                <option value="<?= $prod->pro_no ?>">
                  (<?= $prod->pro_code ?>) <?= $prod->pro_title ?> - <?= $prod->unit_name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Accountable to</label>
            <select name="user_no" id="user_no" class="form-control">
              <?php foreach ($user_details as $user) : ?>
                <option value="<?= $user->user_no ?>">
                  <?= $user->user_lname.', ' .$user->user_fname ?> - <?= $user->depart_title ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="release_quantity" id="quantity" min="1" class="form-control  <?= (form_error('release_quantity') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('release_quantity'); ?></div>
          </div>
          <div class="form-group">
            <label>Date Release</label>
            <input type="date" name="release_date" placeholder="Department Title" class="form-control  <?= (form_error('release_date') != false) ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= form_error('release_date'); ?></div>
          </div>
          <div class="form-group">
            <label>Remarks</label>
            <textarea name="release_remark" class="form-control <?= (form_error('release_remark') != false) ? 'is-invalid' : '' ?>"></textarea>
            <div class="invalid-feedback"><?= form_error('release_remark'); ?></div>
          </div>
          <div class="form-group">
            <input type="submit" value="Release Stock" class="btn btn-primary" id="submit" disabled>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var submit = $('#submit');
    var quantity = 0;
    var remaining = 0;
    var pro_no = 0;

    $(window).keydown(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });

    $('#quantity').change(function() {
      $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>inventories/stocks/' + $('#pro_no').val(),
        dataType: 'json',
        success: function(data) {
          $.each(data, function(i, item) {
            quantity = item.invent_quantity
            pro_no = item.pro_no
          });
          if (pro_no == $('#pro_no').val()) {
            remaining = quantity - $('#quantity').val();
            if (remaining < 0) {
              alert('This product has ' + quantity + ' stocks left.');
              submit.attr("disabled", true);
            } else {
              submit.attr("disabled", false);
            }
          } else {
            alert('This product has 0 stocks left.');
            submit.attr("disabled", true);
          }
        },
        error: function() {
          alert('insufficient stocks');
        }
      });
    });

    $('#pro_no').change(function() {
      $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>inventories/stocks/' + $('#pro_no').val(),
        dataType: 'json',
        success: function(data) {
          $.each(data, function(i, item) {
            quantity = item.invent_quantity
            pro_no = item.pro_no
          });
          if (pro_no == $('#pro_no').val()) {
            remaining = quantity - $('#quantity').val();
            if (remaining < 0) {
              alert('This product has ' + quantity + ' stocks left.');
              submit.attr("disabled", true);
            } else {
              submit.attr("disabled", false);
            }
          } else {
            alert('This product has 0 stocks left.');
            submit.attr("disabled", true);
          }
        },
        error: function() {
          alert('insufficient stocks');
        }
      });
    });

  });
</script>