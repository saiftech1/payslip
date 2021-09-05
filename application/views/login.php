<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon" />
    <title><?php echo $_SESSION['pageTitle']; ?></title>

    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body class="font-muli theme-cyan gradient">
	<form method="post" action="<?php echo site_url('auth/authenticate');?>" autocomplete="off">
    <div class="auth option2">
        <div class="auth_left">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <a class="header-brand" href="#"><i class="fa fa-briefcase brand-logo"></i></a>
                            <div class="card-title mt-3">FUBK Portal*</div>
                            <div class="card-title mt-3">Login to your account</div>
                            <?php if($this->session->flashdata('msg')){ ?>
                            <p class="alert alert-info text-center" style="font-size:14px">
                                <?php echo $this->session->flashdata('msg') ?>
                            </p>
                            <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control text-center" placeholder="Enter Your University Email" required
                                name="sims_username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control text-center" id="exampleInputPassword1"
                                placeholder="Enter Password" required name="sims_password" autocomplete="off">
                    </div>
                    <div class="text-center">
                         <button class="btn btn-primary btn-block" type="submit">Sign in securely</button>
                            <div class="text-muted mt-4">Activate Account? <a href="<?php echo site_url('auth/activate')?>">Click here</a></div>
                            <div class="text-muted mt-4">Forgot Password? <a href="<?php echo site_url('auth/reset')?>">Reset here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</form>
   
    <script src="<?php echo base_url()?>assets/bundles/lib.vendor.bundle.js"
        type="e4a7806aed088581f862dd92-text/javascript"></script>

    <script src="<?php echo base_url()?>assets/js/core.js" type="e4a7806aed088581f862dd92-text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/rocket-loader.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
