<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $_SESSION['pageTitle']; ?></title>

    <link rel="icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/summernote/dist/summernote.css" />

    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>


<body class="font-muli right_tb_toggle <?php echo " ".$_SESSION['theme_mode']; ?>">

    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>
    <div id="main_content">
        <?php $this->load->view('incs/header');?>
        <?php //$this->load->view('incs/rside');?>
        <?php $this->load->view('incs/lside');?>

        <div class="page">

            <?php $this->load->view('incs/pageheader');?>

            <div class="section-body">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center ">
                        <div class="header-action">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="section-body mt-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body w_user">
                                    <div class="user_avtar">
                                        <img class="rounded-circle" src="<?php echo base_url()?>assets/images/image.jpg"
                                            alt="">
                                    </div>
                                    <div class="wid-u-info">
                                        <h5>
                                            <?php echo strtoupper($staff->surname).' '.ucwords(strtolower($staff->firstname.' '.$staff->othernames));?>
                                            <hr>
                                        </h5>

                                        <p class="text-muted m-b-0">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Employee Number </b>
                                                <div><?php echo $staff->username; ?></div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Gender </b>
                                                <div><?php echo $staff->gender; ?></div>
                                            </li>
                                        </ul>
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Designation</b>
                                            <div><?php echo $staff->designation; ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Employe Type </b>
                                            <div><?php echo $staff->employee_type; ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Marital Status </b>
                                            <div><?php echo $staff->marital_status; ?></div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Date of Birth</b>
                                            <div><?php echo $staff->dob; ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Date of First Appointment </b>
                                            <div><?php echo $staff->dofa; ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <b>University Email </b>
                                            <div><?php echo $staff->university_email; ?></div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payslips</h3>
                                    <div class="card-options ">
                                        <a style="float:right" class="btn btn-primary btn-sm btn-small float-right"
                                    href="<?php echo base_url('payslip/myslips')?>"><i class="fa fa-eye"></i> View All Payslips</a>
                                    </div>
									
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-hover js-basic-example dataTable table-striped table_custom border-style spacing5">
                                            <thead>
											<tr>
												<th>#</th>
												<th>Reference</th>
												<th>Period</th>
												<th>Status</th>
												<th>View</th>
												<th>Notification</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; foreach($payslips as $row){ ?>
											<tr>
												<td>
													<?php echo $i++; ?>
												</td>
												<td> 
													<?php echo $row->reference ?> 
												</td>
												<td>
													<?php echo $row->month." ".$row->year; ?> 
												</td>
												<td>
													<span>
													<a class="text-success"> <i class="fa fa-check-circle"></i> Approved</a>
													</span>
												</td>
												<td class="text-primary">
													<span>
													<a target="_blank" href="<?php echo site_url('payslips/'.$row->month.$row->year.'/'.$row->filename);?>" >  <i class="fa fa-eye"></i> View Payslip</a>
													</span>
												</td>
												<td class="text-left">
													<span>
														<a href="<?php echo site_url('payslip/notify/'.$row->hash);?>"><i class="fa fa-envelope"></i> Send via Email</a>
													</span>
												</td>
												
											</tr>
											<?php } ?>
										</tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
        <?php $this->load->view('incs/footer');?>
        </div>

    </div>
	

    <script src="<?php echo base_url()?>assets/bundles/lib.vendor.bundle.js"
        type="e27f9daa9c2f25670b2c3761-text/javascript"></script>

    <script src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="e27f9daa9c2f25670b2c3761-text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/dropify/js/dropify.min.js"
        type="e27f9daa9c2f25670b2c3761-text/javascript"></script>
    <script src="<?php echo base_url()?>assets/bundles/summernote.bundle.js"
        type="e27f9daa9c2f25670b2c3761-text/javascript"></script>

    <script src="<?php echo base_url()?>assets/js/core.js" type="e27f9daa9c2f25670b2c3761-text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/form/dropify.js" type="e27f9daa9c2f25670b2c3761-text/javascript">
    </script>
    <script src="<?php echo base_url()?>assets/js/page/summernote.js" type="e27f9daa9c2f25670b2c3761-text/javascript">
    </script>
    <script src="<?php echo base_url()?>assets/js/rocket-loader.min.js" data-cf-settings="e27f9daa9c2f25670b2c3761-|49"
        defer=""></script>
</body>

</html>
