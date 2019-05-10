<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="<?= base_url() ?>requests/create" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Request</a>
          </div>
          <div class="text-monospace">
            <h2>REQUESTS LIST</h2>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table id="user-table" class="table table-bordered table-striped table-hover center">
              <thead>
                <tr>
                  <th>request_no</th>
                  <th>user_no</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Code</th>
                  <th>Purpose</th>
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
      processing: true,
      serverSide: true,
      "ajax": {
        url: "<?php echo site_url("requests/requests_page") ?>",
        type: 'GET'
      },
      columns: [{},
        {},
        {},
        {},
        {},
        {},
        /* EDIT */
        {
          mRender: function(data, type, row) {
            <?php if ($this->session->userdata('role_id') == 4) : ?>
              if (row[1] == <?= $this->session->userdata('user_no') ?>) {
                return `
                  <button class='btn btn-primary mb-1' name='edit'><i class='fa fa-pencil fa-fw'  aria-hidden='true'></i></button>
                  <button class='btn btn-danger mb-1' name='delete'>
                  <i class='fa fa-trash-o fa-fw' aria-hidden='true'></i>
                  </button>
                  <button class='btn btn-info mb-1' name='show'><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>`;
              } else {
                return `
                  <button class='btn btn-info mb-1' name='show'><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>`;
              }
            <?php endif; ?>
          }
        }
      ],
      "columnDefs": [{
          "width": "17%",
          "targets": -1,
          "data": null,
          "defaultContent": `
          <button class='btn btn-primary mb-1' name='edit'><i class='fa fa-pencil fa-fw' aria-hidden='true'></i></button>
          <button class='btn btn-danger mb-1' name='delete'>
          <i class='fa fa-trash-o fa-fw' aria-hidden='true'></i>
          </button>
          <button class='btn btn-info mb-1' name='show'><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>`
        },
        {
          "targets": [0],
          "visible": false,
          "searchable": false
        },
        {
          "targets": [1],
          "visible": false,
          "searchable": false
        }
      ],
      "aLengthMenu": [
        [5, 10, 15, 20, 25, -1],
        [5, 10, 15, 20, 25, "All"]
      ],
      "iDisplayLength": 5
    });
    $('#user-table tbody').on('click', 'button', function() {
      var data = table.row($(this).parents('tr')).data();
      if (this.name == 'edit') {
        window.location = '<?= base_url() ?>requests/edit/' + data[0];
      } else if (this.name == 'delete') {
        if (confirm('Do you want to delete?')) {
          window.location = '<?= base_url() ?>requests/soft_delete/' + data[0];
        }
      } else if (this.name == 'show') {
        window.location = '<?= base_url() ?>requests/show/' + data[0];
      }
    });
  });
</script>