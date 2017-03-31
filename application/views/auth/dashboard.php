<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo $projectsCount; ?></h3>

                <p>Projects</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
            <?php echo anchor("projects/add", ' Add new <i class="fa fa-arrow-circle-right"></i>', array('class'=>'small-box-footer')); ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $agenciesCount; ?></h3>

                <p>Agencies</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?php echo anchor("agency", ' See all <i class="fa fa-arrow-circle-right"></i>', array('class'=>'small-box-footer')); ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo $inWork; ?></h3>

                <p>Projects in Work</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <?php echo anchor("projects", ' See all <i class="fa fa-arrow-circle-right"></i>', array('class'=>'small-box-footer')); ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo $clientsNumber; ?></h3>

                <p>Accounts</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <?php echo anchor("users/create_user", ' Add new <i class="fa fa-arrow-circle-right"></i>', array('class'=>'small-box-footer')); ?>        </div>
    </div>
    <!-- ./col -->

</div>