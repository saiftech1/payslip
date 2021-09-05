<div id="header_top" class="header_top">
    <div class="container">
        <div class="hleft">
            <a class="header-brand" href="<?php echo site_url($_SESSION['home_url'])?>"><i
                    class="fa fa-briefcase brand-logo"></i></a>
            <div class="dropdown">
                <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-align-center"></i></a>
                <a href="<?php echo site_url('auth/change_theme/'.$this->router->fetch_class().'/'.$this->router->fetch_method());?>" class="nav-link icon theme_btn"><i class="fa fa-feather"></i></a>
            </div>
        </div>
        <div class="hright">
            <a href="<?php echo site_url('auth/logout')?>" class="nav-link icon"><i class="fa fa-power-off"></i></a>
        </div>
    </div>
</div>
