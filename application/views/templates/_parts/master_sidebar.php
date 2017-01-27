<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php if($this->uri->segment(1)=="users"){echo "active";}?>"><?php echo anchor("users/", ' <i class="fa fa-link"></i> <span>Users</span>'); ?></li>

            <li class="treeview <?php if($this->uri->segment(1)=="projects"){echo "active";}?>">
                <a href="#"><i class="fa fa-link"></i><span>Projects</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

                <ul class="treeview-menu">
                    <li class="<?php if($this->uri->segment(1)=="projects" && $this->uri->segment(2)== NULL){echo "active";}?>">
                        <?php echo anchor("projects/", ' <i class="fa fa-link"></i><span>View</span> <span class="pull-right-container"></span>'); ?>
                    </li>

                    <?php if ($this->ion_auth->is_admin()): ?>
                    <li class="<?php if($this->uri->segment(2)=="add"){echo "active";}?>">
                        <?php echo anchor("projects/add", ' <i class="fa fa-link"></i> Add new'); ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>

            <li class="treeview <?php if($this->uri->segment(1)=="form"){echo "active";}?>">
                <a href="#"><i class="fa fa-link"></i><span>Forms</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

                <ul class="treeview-menu">

                    <li class="<?php if($this->uri->segment(1)=="form" && $this->uri->segment(2)== NULL){echo "active";}?>">
                        <?php echo anchor("form/", ' <i class="fa fa-link"></i><span>View</span> <span class="pull-right-container"></span>'); ?>
                    </li>

                    <?php if ($this->ion_auth->is_admin()): ?>
                        <li class="<?php if($this->uri->segment(2)=="add"){echo "active";}?>">
                            <?php echo anchor("form/add", ' <i class="fa fa-link"></i> Add new'); ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>