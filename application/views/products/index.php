<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="float-right">
            <a href="<?= base_url() ?>products/create" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Product</a>
          </div>
          <div class="text-monospace">
            <h2>PRODUCTS LIST</h2>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table id="product-table" class="table table-bordered table-striped table-hover center">
              <thead>
                <tr>
                  <th>pro_no</th>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Unit</th>
                  <th>Type</th>
                  <th>Category</th>
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
    var table = $('#product-table').DataTable({
      "pageLength": 5,
      "ajax": {
        url: "<?php echo site_url("products/products_page") ?>",
        type: 'GET'
      },
      "columnDefs": [{
        "width": "15%",
        "targets": -1,
        "data": null,
        "defaultContent": `
        <button class='btn btn-primary' name='edit'><i class='fa fa-pencil fa-fw' aria-hidden='true'></i></button>
        <button class='btn btn-danger' name='delete'>
        <i class='fa fa-trash-o fa-fw' aria-hidden='true'></i>
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
    $('#product-table tbody').on('click', 'button', function() {
      var data = table.row($(this).parents('tr')).data();
      if (this.name == 'edit') {
        window.location = '<?= base_url() ?>products/edit/' + data[0];
      } else if (this.name == 'delete') {
        if (confirm('Are you sure to delete this product?')) {
          window.location = '<?= base_url() ?>products/soft_delete/' + data[0];
        }
      }
    });
  });
</script>