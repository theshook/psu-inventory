<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="<?= base_url() ?>users/create" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i> New User</a>
          </div>
          <div class="text-monospace">
            <h2>USER LIST</h2>
          </div>
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
        <button class='btn btn-primary mb-1' name='edit'><i class='fa fa-pencil fa-fw' aria-hidden='true'></i></button>
        <button class='btn btn-danger mb-1' name='delete'>
        <i class='fa fa-trash-o fa-fw' aria-hidden='true'></i>
        </button>
        <button class='btn btn-info mb-1' name='show'><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>
        <button class='btn btn-secondary mb-1' name='account'><i class="fa fa-key fa-fw" aria-hidden="true"></i></i></i></button>`
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
        if (confirm('Are you sure to delete this user?')) {
          window.location = '<?= base_url() ?>users/soft_delete/' + data[0];
        }
      } else if (this.name == 'show') {
        window.location = '<?= base_url() ?>users/show/' + data[0];
      } else if (this.name == 'account') {
        window.location = '<?= base_url() ?>userslogin/create/' + data[0];
      }
    });
  });
</script>