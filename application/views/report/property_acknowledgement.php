<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="text-monospace">
            <h2>Property Acknowledgement List</h2>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table id="department-table" class="table table-bordered table-striped table-hover center">
              <thead>
                <tr>
                  <th>user_no</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#department-table').DataTable({
      "pageLength": 5,
      "ajax": {
        url: "<?php echo site_url("reports/property_acknowledgement_data") ?>",
        type: 'GET'
      },
      "columnDefs": [{
        "width": "7%",
        "targets": -1,
        "data": null,
        "defaultContent": `
        <button class='btn btn-secondary' name='show'><i class='fa fa-search fa-fw' aria-hidden='true'></i></button>`
      }, {
        "targets": [0],
        "visible": false,
        "searchable": false
      }],
      "aLengthMenu": [
        [5, 10, 15, 20, 25, -1],
        [5, 10, 15, 20, 25, "All"]
      ],
      "iDisplayLength": 5
    });
    $('#department-table tbody').on('click', 'button', function() {
      var data = table.row($(this).parents('tr')).data();
      if (this.name == 'show') {
        window.location = '<?= base_url() ?>reports/property_acknowledgement_show/' + data[0];
      }
    });
  });
</script>