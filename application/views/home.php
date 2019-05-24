<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display display">Home</h2>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <form method="GET">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <input type="text" name="dates" class="form-control" placeholder="Select Date" value="<?= $this->input->get('dates') ?>" aria-label="Input group example" aria-describedby="btnGroupAddon">
                  <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
              </form>
              <div id="chart_div"></div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header text-center">
                  <h3>Requests Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                  <?php foreach ($notifications as $notification) : ?>
                    <li class="list-group-item">
                      <?= $notification->user_lname. ', '. $notification->user_fname ?>
                      <strong><?= $notification->depart_title ?></strong>
                      <span class="pull-right"><?= date('M d, Y h:i A', strtotime($notification->request_encode_date)) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Departments');
        data.addColumn('number', 'total');
        data.addRows([
          <?php foreach ($total_requests as $total_request) : ?>
            ['<?= $total_request->depart_title ?>', <?= $total_request->total ?>],
          <?php endforeach; ?>
        ]);

        // Set chart options
        var options = {'title':'Number of Requests',
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
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
</script>