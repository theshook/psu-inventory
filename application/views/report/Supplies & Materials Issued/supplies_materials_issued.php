<?php
  $months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
  );
?>
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
    text-decoration: underline;
  }
  .remove-top-border {
    border: none;
  }
}
</style>
<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-body">
      <?= form_open('reports/supplies_materials_issued', array('method' => 'get')); ?>
        <div class="form-group row m-0">
          <div class="col-sm-3">
            <select name="year" id="year" class="form-control">
              <option value="null">Select Year</option>
              <?php foreach($get_year as $year): ?>
                <option value="<?= $year->year ?>" <?= ($year->year == $this->input->get('year')) ? 'selected' : '' ?>>
                  <?= $year->year ?>
                </option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-sm-3">
            <select name="month" id="month" class="form-control">
              <option value="null">Select Month</option>
              <?php foreach($months as $key => $month):?>
                <option value="<?= $key+1 ?>" <?= ($key+1 == $this->input->get('month')) ? 'selected' : '' ?>><?= $month ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-outline-success btn-block">View</button>
          </div>
        </div>
      <?= form_close(); ?> 
      <?php if ($this->input->get('year') != 'null' && $this->input->get('month') != null) : ?>
        <button id="btn_print" class="btn btn-outline-success btn-block">PRINT RECORD</button>
      <?php endif; ?>
    </div>
  </div>
  <?php if ($this->input->get('year') != 'null' && $this->input->get('month') != null): ?>
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card" id="print">
          <div class="card-header">
            <div class="text-center">
              <p class="display display">REPORT OF SUPPLIES AND MATERIALS ISSUED</p>
              <h2 class="display display">PANGASINAN STATE UNIVERSITY</h2>
              <p class="display display">Infanta, Pangasinan</p>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th scope="col" class="text-center">Stock No.</th>
                  <th scope="col" class="text-center">Item</th>
                  <th scope="col" class="text-center">Unit</th>
                  <th scope="col" class="text-center">QTY. Issued</th>
                  <th scope="col" class="text-center">Unit Cost </th>
                  <th scope="col" class="text-center">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($monthly as $key => $month): ?>
                  <tr>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center"><?= $month->pro_no ?></td>
                    <td class="text-center"><?= $month->pro_title ?></td>
                    <td class="text-center"><?= $month->unit_name ?></td>
                    <td class="text-center"><?= $month->release_quantity ?></td>
                    <td class="text-center"><?= $month->pro_price ?></td>
                    <td class="text-center"><?= ($month->amount) ? $month->amount : 'N/A' ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td>&nbsp;</td>
                  <td class="text-right" colspan="5"><strong>TOTAL</strong></td>
                  <td class="text-center"><?= (!empty($total->amount)) ? $total->amount : 'N/A' ?></td>
                </tr>
                <tr>
                  <th>&nbsp;</th>
                  <th class="text-center" colspan="2">RECAPITULATION</th>
                  <th colspan="2">&nbsp;</th>
                  <th class="text-center" colspan="2">RECAPITULATION</th>
                </tr>
                <tr>
                  <th>&nbsp;</th>
                  <th class="text-center">Stock No.</th>
                  <th class="text-center">Quantity</th>
                  <th colspan="2">&nbsp;</th>
                  <th class="text-center">Unit Cost</th>
                  <th class="text-center">Total Cost</th>
                </tr>
                <?php foreach($monthly as $key => $month): ?>
                  <tr>
                    <td>&nbsp;</td>
                    <td class="text-center"><?= $month->pro_no ?></td>
                    <td class="text-center"><?= $month->release_quantity ?></td>
                    <td colspan="2">&nbsp;</td>
                    <td class="text-center"><?= $month->pro_price ?></td>
                    <td class="text-right"><?= ($month->amount) ? $month->amount : 'N/A' ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td>&nbsp;</td>
                  <td class="text-right" colspan="6">
                    <?= (!empty($total->amount)) ? $total->amount : 'N/A' ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" height="100">I hereby certify to the correctness of the above information</td>
                  <td colspan="4" height="100">Posted by/date</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-center">
                    ___________________________________
                    <br>
                    <?= $this->session->userdata('user_lname'). ', '. $this->session->userdata('user_fname') ?>
                    <br>
                    <?= $this->session->userdata('role_name') ?>
                  </td>
                  <td colspan="4" class="text-center">
                    <u><input type="text" style="color: rgb(102, 102, 102);" name="" placeholder="Enter Accountant Name" class="text-center w-100"></u>
                    <br>
                    Accountant
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<script>
  $(document).ready(function() {
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