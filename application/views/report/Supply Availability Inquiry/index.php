<style type="text/css">
  @media print {
  button {
    display: none !important;
  }
  input,
  textarea {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
  }
  .remove-top-border {
    border: none;
  }
}
</style>
<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-body">
      <?= form_open('reports/supply_availability_inquiry', array('method' => 'get')); ?>
        <div class="form-group row m-0">
          <div class="col-sm-3">
            <input type="text" name="dates" class="form-control" placeholder="Select Date" value="<?= $this->input->get('dates') ?>">
          </div>
          <div class="col-sm-3">
            <select name="cat_no" id="cat_no" class="form-control">
              <option value="null">Select Category</option>
              <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat->cat_no ?>" <?= ($this->input->get('cat_no') == $cat->cat_no) ? 'selected' : '' ?>>
                  <?= $cat->cat_name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-outline-success btn-block">View</button>
          </div>
        </div>
      <?= form_close(); ?> 
      <button id="btn_print" class="btn btn-outline-success btn-block">PRINT RECORD</button>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card" id="print">
        <div class="card-header">
          <div class="text-center">
            <h1>SUPPLIES AVAILABILITY INQUIRY</h1>
            <h2 class="display display"><u>PANGASINAN STATE UNIVERTY</u></h2>
            <h2 class="display display"><u>Agency</u></h2>
            <p class="text-right">
              <?php if ($this->input->get('dates')) : ?>
                <?php $dates = explode("_", $this->input->get('dates')); ?>
                From: <strong><?= date('M d Y', strtotime($dates[0])); ?></strong> 
                To: <strong><?= date('M d Y', strtotime($dates[1])); ?></strong>
              <?php else : ?>
                Date: <strong><?= date('M d Y'); ?></strong>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table id="department-table" class="table table-hover center">
              <thead>
                <tr>
                  <th colspan="2">
                    Division: <br>
                    Office: 
                  </th>
                  <th colspan="2">
                    Responsibility Center: <br>
                    Code: 
                  </th>
                  <th colspan="2">
                    ____________________
                  </th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th width="30">Stock Code</th>
                  <th>Items/Description</th>
                  <th>Unit</th>
                  <th>Quantity</th>
                  <th>Status of Stock</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $key => $prod): ?>
                  <tr>
                    <td><?= $prod->pro_code ?></td>
                    <td><?= $prod->pro_title ?></td>
                    <td><?= $prod->unit_name ?></td>
                    <td>
                      <?php if ($release[$key]->pro_no == $prod->pro_no): ?>
                        <?= $prod->quantity - $release[$key]->total_release ?>
                      <?php endif; ?>
                    </td>
                    <td></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="5">
                    <div class="form-group row m-0">
                      <label for="purpose" class="col-sm-2 col-form-label">Purpose/Remarks:</label>
                      <div class=" col-sm-8">
                        <input type="text" name="purpose" placeholder="Purpose / Remarks" class="form-control">
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td height="100" colspan="3" class="text-center">Inquired by:</td>
                  <td height="100" colspan="3">Status provided by (Supply Office)</td>
                </tr>
                <tr class="table-borderless">
                  <td colspan="3" class="text-center">
                    <input type="text" name="purpose" placeholder="Name" class="form-control text-center font-weight-bold">
                    <input type="text" name="purpose" placeholder="Position" class="form-control text-center">
                  </td>
                  <td colspan="3" class="text-center">
                    Signature _________________________________
                    <input type="text" name="purpose" placeholder="Name" class="form-control text-center">
                    <input type="text" name="purpose" placeholder="Position" class="form-control text-center font-weight-bold">
                  </td>
                </tr>
                <tr class="table-borderless">
                  <td colspan="3">Date: ______________________________</td>
                  <td colspan="3">Date: ______________________________</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('input[name="dates"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });

    $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + '_' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#btn_print').click(function(){
      $("#print").print({
        globalStyles: true,
        mediaPrint: false,
        stylesheet: null,
        noPrintSelector: ".no-print",
        iframe: true,
        append: null,
        prepend: null,
        manuallyCopyFormValues: true,
        deferred: $.Deferred(),
        timeout: 750,
        title: null,
        doctype: '<!doctype html>'
      });
    });
  });
</script>