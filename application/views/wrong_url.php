<link href="<?php echo base_url('assets/css/lib/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">

<style type="text/css">
.error-template {padding: 200px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; margin-top: 5px;}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1 class="text-danger">Oops!</h1>
                <h2>Page Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary btn-lg">
                    	<span class="glyphicon glyphicon-home"></span> Dashboard 
                    </a>
                    <a href="javascript:window.history.go(-1);" class="btn btn-success btn-lg">
                    	<span class="glyphicon glyphicon-menu-left"></span> Previous 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>