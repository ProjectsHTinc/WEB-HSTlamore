<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Lila moreAdmin</title>
    <meta name="description" content="" />
    <meta name="keywords" content="a" />
    <meta name="author" content="" />
    <link href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet" type="text/css">
	  <script src="<?php echo base_url(); ?>assets/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/additional-methods.min.js"></script>


</head>
<body>
  <div class="container-fluid">
  <!-- Row -->
  <div class="table-struct full-width full-height">
    <div class="table-cell vertical-align-middle">
      <div class="auth-form  ml-auto mr-auto no-float">
        <div class="panel panel-default card-view mb-0">
          <div class="panel-heading">
            <div class="pull-left">
              <h6 class="panel-title txt-dark">Register Email  Address to Reset </h6>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <div class="form-wrap">
                    <form action="#" method="post" enctype="multipart/form-data" id="loginform" name="loginform">
                      <div class="form-group">
                        <label class="control-label mb-10" for="exampleInputEmail_2">Email</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="email" id="exampleInputEmail_2" placeholder=" Email">
                          <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                        </div>
                      </div>
                      <div class="form-group">

                        <a class="capitalize-font txt-danger block pt-5 pull-right" href="<?php echo base_url(); ?>adminlogin/">Login here</a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Reset</button>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Row -->
</div>

</div>
</body>
<script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/Counter-Up/jquery.counterup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/dropdown-bootstrap-extended.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/morris-data.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.js"></script>


<!-- <script src="<?php echo base_url(); ?>/assets/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script> -->
<script src="<?php echo base_url(); ?>/assets/dist/js/init.js"></script>
<!-- <script src="<?php echo base_url(); ?>/assets/dist/js/dashboard-data.js"></script> -->
<script>
$('#loginform').validate({ // initialize the plugin
    rules: {
        email: {required: true,email:true },

    },
    messages: {
        email: { required:"Enter the valid email" }

    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>adminlogin/resetpassword",
            type: 'POST',
            data: $('#loginform').serialize(),
            success: function(response) {

                if (response == "success") {
                  swal({
                  title: "Success",
                  text: " Password has been sent Register Email ",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>adminlogin/';
              });

                } else{

                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});
</script>
<style>
.error{
  color:red;
  font-weight: 400;
}

</style>
</html>
