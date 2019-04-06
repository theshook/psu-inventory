<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">User List</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table id="user-table" class="table table-bordered table-striped table-hover center">
              <thead>
                <tr>
                  <th>user_no</th>
                  <th>Id Number</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
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
    var table = $('#user-table').DataTable({
      "pageLength": 5,
      "ajax": {
        url: "<?php echo site_url("users/users_page") ?>",
        type: 'GET'
      },
      "columnDefs": [{
        "width": "15%",
        "targets": -1,
        "data": null,
        "defaultContent": `
        <button class='btn btn-primary' name='edit'><i class='fa fa-pencil fa-2x' aria-hidden='true'></i></button>
        <button class='btn btn-danger' name='delete'>
        <i class='fa fa-trash-o fa-2x' aria-hidden='true'></i>
        </button>`
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
    $('#user-table tbody').on('click', 'button', function() {
      var data = table.row($(this).parents('tr')).data();
      if (this.name == 'edit') {
        window.location = '<?= base_url() ?>users/edit/' + data[0];
      } else if (this.name == 'delete') {
        if (confirm('Are you sure to hide')) {
          window.location = '<?= base_url() ?>users/soft_delete/' + data[0];
        }
      }
    });
  });
</script>