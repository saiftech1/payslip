<?php
	if(!isset($_SESSION['loginStatus']) or !isset($_SESSION['username'])){
		redirect('auth/logout', 'refresh');
	}
	$roleid = $_SESSION['roleid'];?>
<div id="left-sidebar" class="sidebar">
    <h5 class="brand-name">FUBK-HR</h5>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu-uni"><?php echo $_SESSION['shortName'];?></a></li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="menu-uni" role="tabpanel">
            <nav class="sidebar-nav">
                
				<ul class="metismenu">
                    <li class="active">
						<a href="<?php echo site_url('staff/index');?>"><i class="fa fa-home"></i><span>Home</span></a>
					</li>
                    <li>
						<a href="<?php echo site_url('staff/view');?>"><i class="fa fa-user"></i><span>My Profile</span></a>
					</li>
                    <li>
						<a href="<?php echo site_url('payslip/myslips');?>"><i class="fa fa-dollar"></i><span>My Payslips</span></a>
					</li>
                    <li>
						<a href="#<?php echo site_url('leave/myleave');?>"><i class="fa fa-map-signs"></i><span>Leave Request</span></a>
					</li>
                    <li>
						<a href="#<?php //echo site_url('training/');?>"><i class="fa fa-network-wired"></i><span>Staff Training</span></a>
					</li>
                    <li>
						<a href="#<?php //echo site_url('promotion/');?>"><i class="fa fa-fast-forward"></i><span>Promotion</span></a>
					</li>
                </ul>
				
				<?php if($roleid == '6'){ //Registrar?>
				<hr> <h6 class="brand-name font-16">Extra Actions</h6> <hr>
				<ul class="metismenu">
                    <li>
						<a href="<?php echo site_url('staff/viewall');?>"><i class="fa fa-chalkboard-teacher"></i><span>Staff Manager</span></a>
					</li>
                    <!--<li>
						<a href="<?php echo site_url('leave');?>"><i class="fa fa-users"></i><span>Leave Manager</span></a>
					</li>-->
                    <li>
						<a href="<?php echo site_url('payslip');?>"><i class="fa fa-users"></i><span>Payslip Manager</span></a>
					</li>
                    <!--<li>
						<a href="<?php echo site_url('training');?>"><i class="fa fa-book"></i><span>Training Manager</span></a>
					</li>
                    <li>
						<a href="<?php echo site_url('promotion');?>"><i class="fa fa-hand-holding-usd"></i><span>Promotion Manager</span></a>
					</li>
                    <li>
						<a href="<?php echo site_url('recruitment');?>"><i class="fa fa-calendar-check-o"></i><span>Recruitment Manager</span></a>
					</li>
					<li class="active">
						<a href="<?php echo site_url('registrar');?>"><i class="fa fa-tachometer-alt"></i><span>Analytics</span></a>
					</li>
                    
                    <li>
						<a href="<?php echo site_url('setting');?>"><i class="fa fa-cogs"></i><span>Settings</span></a>
					</li>-->
                </ul>
				
				<?php }?>
            </nav>
        </div>
    </div>
</div>
