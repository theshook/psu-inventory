<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-3 mb-2">
      <button id="btn_print" class="btn btn-outline-success btn-block">PRINT RECORD</button>
    </div>
    <div class="col-sm-12">
      <div class="card" id="print">
        <div class="card-header">
          <div class="text-center">
            <p class="display display">Republic of the Philippines</p>
            <h2 class="display display">Property Acknowledgement</h2>
            <p class="text-right">Date: <strong><?= date('M d Y'); ?></strong></p>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Unit</th>
                <th scope="col">Products</th>
				<th scope="col">Quantity</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($accountable as $acc) : ?>
                <tr>
                  <th scope="row"><?= $acc->pro_code ?></th>
                  <td><?= $acc->unit_name ?></td>
                  <td><?= $acc->pro_title ?></td>
				  <td><?= $acc->release_quantity ?></td>
                  <td><?= date('M d Y', strtotime($acc->acc_encode_date)) ?></td>
                  <td><?= $acc->pro_price ?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <th scope="col" colspan="5" class="text-right">AMOUNT</th>
                <td><?= $total->amount ?></td>
              </tr>
              <tr>
                <td colspan="4">
                  Received By:
                </td>
                <td colspan="3">Received From:</td>
              </tr>
              <tr>
                <td height="100" colspan="3" class="text-center align-bottom"><?= $from[0]->user_lname .', '. $from[0]->user_fname ?></td>
                <td height="100" colspan="3" class="text-center align-bottom"></td>
              </tr>
              <tr>
                <td colspan="3" class="text-center">Signature Over Printed Name</td>
                <td colspan="3" class="text-center">Signature Over Printed Name</td>
              </tr>
              <tr>
                <td height="100" colspan="3" class="text-center align-middle">
                  
                  <u>&nbsp;&nbsp;&nbsp;&nbsp;<?= $from[0]->depart_title ?>&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                  Position/Office
                </td>
                <td height="100" colspan="3" class="text-center align-middle">
                  <u>&nbsp;&nbsp;&nbsp;&nbsp;Supply Officer&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                  Position/Office
                </td>
              </tr>
              <tr>
                <td colspan="3" class="text-left">Date: <strong><?= date('M d Y'); ?></strong></td>
                <td colspan="3" class="text-left">Date:</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
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