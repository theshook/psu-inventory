<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <p>Your company &copy; 2017-2019</p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Design by <a href="#" class="external">Me ♥</a>
        </p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
      </div>
    </div>
  </div>
</footer>
</div>
<script>
  $(document).ready(function() {
    var duration = 4000; // 4 seconds
    setTimeout(function() {
      $('#success-alert').slideUp("fast", function() {
        <?php unset($_SESSION['success']); ?>
        <?php unset($_SESSION['error']); ?>
      });
    }, duration);
  });
</script>
<!-- JavaScript files-->
<script src="<?= base_url() . 'assets/' ?>vendor/popper.js/umd/popper.min.js"> </script>
<script src="<?= base_url() . 'assets/' ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() . 'assets/' ?>js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="<?= base_url() . 'assets/' ?>vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="<?= base_url() . 'assets/' ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url() . 'assets/' ?>vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() . 'assets/' ?>vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= base_url() . 'assets/' ?>js/charts-home.js"></script>
<!-- Main File-->
<script src="<?= base_url() . 'assets/' ?>js/front.js"></script>
</body>

</html>