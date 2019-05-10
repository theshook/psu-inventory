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
<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-body">
      <?= form_open('reports/yearly_issued_summary', array('method' => 'get')); ?>
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
            <button class="btn btn-outline-success btn-block">View</button>
          </div>
        </div>
      <?= form_close(); ?> 
      <?php if ($this->input->get('year') != 'null' && $this->input->get('year') != null) : ?>
        <button id="btn_print" class="btn btn-outline-success btn-block">PRINT RECORD</button>
      <?php endif; ?>
    </div>
  </div>
  <?php if ($this->input->get('year') != 'null' && $this->input->get('year') != null): ?>
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card" id="print">
          <div class="card-header">
            <div class="text-center">
              <p class="display display">Republic of the Philippines</p>
              <h2 class="display display">PANGASINAN STATE UNIVERSITY</h2>
              <p class="display display">Infanta, Pangasinan</p>
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <p>SUMMARY</p>
              <p>REPORT OF SUPPLIES AND MATERIALS ISSUED FOR the Calendar Year <?= $this->input->get('year') ?></p>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center">MONTH</th>
                  <th scope="col" class="text-center">AMOUNT</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($monthly as $month): ?>
                  <tr>
                    <td><?= $months[$month->month-1]?></td>
                    <td class="text-center"><?= $month->amount ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td>&nbsp;</td>
                  <td class="text-center">
                    <strong class="text-left">TOTAL</strong> &nbsp;
                    <?= $total->amount ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <table class="table table-borderless">
              <tr>
              <td height="100" width="25%">Prepare By:</td>
              <td class="align-bottom">
                <strong>
                  <?= 
                    $this->session->userdata('user_fname') . ' ' . 
                    $this->session->userdata('user_lname')
                  ?> 
                </strong>
                <br>
                <?= 
                    $this->session->userdata('depart_title')
                  ?> 
              </td>
            </tr>
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