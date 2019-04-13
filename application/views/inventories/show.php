<div class="container-fluid mt-2">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Show Stock Information for <strong><?= $stocks[0]->pro_title ?></strong></h2>
        </div>
        <div class="card-body">
          <p><strong>Stock</strong></p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Products</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity</th>
                <th scope="col">Supplier</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($stocks as $stock) : ?>
                <tr>
                  <th scope="row"><?= $stock->pro_code ?></th>
                  <td><?= $stock->pro_title ?></td>
                  <td><?= $stock->unit_name ?></td>
                  <td><?= $stock->invent_quantity ?></td>
                  <td><?= $stock->sup_name ?></td>
                  <td><?= date('M d Y', strtotime($stock->invent_date)) ?></td>
                  <td><a href="<?= base_url() ?>inventories/edit/<?= $stock->invent_no ?>" class="btn btn-info btn-block">Edit</a></td>
                  <td><a href="<?= base_url() ?>inventories/soft_delete/<?= $stock->invent_no ?>" onClick="return confirm('Do you want to delete?')" class="btn btn-danger btn-block">Delete</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <p><strong>Release</strong></p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Products</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($release as $rel) : ?>
                <tr>
                  <th scope="row"><?= $rel->pro_code ?></th>
                  <td><?= $rel->pro_title ?></td>
                  <td><?= $rel->unit_name ?></td>
                  <td><?= $rel->release_quantity ?></td>
                  <td><?= date('M d Y', strtotime($rel->release_date)) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>