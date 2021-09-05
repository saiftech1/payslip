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
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
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
                            <h1 class="page-title">Staff</h1>
                            <ol class="breadcrumb page-breadcrumb">
                                <li class="breadcrumb-item"><a href="#">FUBK-HR</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Staff</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-body mt-4">
                <div class="container-fluid">
                    <div class="card-footer text-left">
                        <div class="row">
                            <div class="col-12">
                                <div class="font-18 font-weight-bolder uppercase">
									PERSONAL INFORMATION
									<a class="nav-link float-right p-10" href="<?php echo site_url('staff/view'); ?>"><i class="fa fa-user"></i>Back to Profile </a>
								</div>
								<hr>
                            </div>
                            <div class="col-12">
                                <div class="font-18 font-weight-bolder alert alert-warning text-center">
                                    You can only edit your contact information. For any other correction or update, contact the Registry department
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Title</div>
                                <div><?php echo $staff->title; ?></div>
                            </div>
							<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Staff Name</div>
                                <div><?php echo strtoupper($staff->surname).' '.ucwords(strtolower($staff->firstname.' '.$staff->othernames));?></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Gender</div>
                                <div><?php echo $staff->gender; ?></div>
                            </div>
							<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Date of Birth</div>
                                <div><?php echo $staff->dob; ?></div>
                            </div>
                            
                        </div>
                        <div class="row">
							<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Marital Status</div>
                                <div><?php echo $staff->marital_status; ?></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">State of Origin</div>
                                <div><?php echo $contact_info->state_name; ?></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">LGA of Origin</div>
                                <div><?php echo $contact_info->lga_name; ?></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                <div class="font-18 font-weight-bold">Town of Birth</div>
                                <div><?php echo $contact_info->town; ?></div>
                            </div>
                            
                            
                        </div>
                        <form action="<?php echo site_url('staff/saveEdit')?>" method="post">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                    <div class="font-18 font-weight-bold">University Email</div>
                                    <div><?php echo $staff->university_email; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 p-10">
                                    <div class="font-18 font-weight-bold">Phone number</div>
                                    <div><input type="number" class="form-control" required value="<?php echo $contact_info->personal_phone; ?>" name="phone" /></div>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 p-10">
                                    <div class="font-18 font-weight-bold">Personal Email</div>
                                    <div><input type="email" class="form-control" required value="<?php echo $contact_info->personal_email; ?>" name="personal_email" /></div>
                                </div>
                                <div class="col-12 p-10">
                                    <div class="font-18 font-weight-bold">Contact Address</div>
                                    <div><textarea required class="form-control" name="contact_address" rows="3"><?php echo $contact_info->contact_address; ?></textarea></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-10">
                                    <div><input type="submit" name="submit" value="Update Contact Information"class="form-control btn btn-success" /></div>
                                </div>
                            </div>
                        </form>
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

            <script src="<?php echo base_url()?>assets/js/core.js" type="e27f9daa9c2f25670b2c3761-text/javascript">
            </script>
            <script src="<?php echo base_url()?>assets/js/form/dropify.js"
                type="e27f9daa9c2f25670b2c3761-text/javascript">
            </script>
            <script src="<?php echo base_url()?>assets/js/page/summernote.js"
                type="e27f9daa9c2f25670b2c3761-text/javascript">
            </script>
            <script src="<?php echo base_url()?>assets/js/rocket-loader.min.js"
                data-cf-settings="e27f9daa9c2f25670b2c3761-|49" defer=""></script>
				
    <script src="<?php echo base_url()?>assets/js/table/datatable.js" type="7ab396837eea337a09d7c15b-text/javascript"></script>
	<script src="<?php echo base_url()?>assets/bundles/dataTables.bundle.js" type="7ab396837eea337a09d7c15b-text/javascript"></script>
</body>

</html>
