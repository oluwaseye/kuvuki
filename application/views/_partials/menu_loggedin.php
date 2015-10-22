 <body>
    <!-- Fixed navbar -->
 <nav class="navbar navbar-default navbar-fixed-top" >
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo.png" style="width:120px;" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav">
          <li <?php echo $active_tech;?>><a href="<?php echo base_url()?>technology/">Tech</a></li>
          <li <?php echo $active_politics;?>><a href="<?php echo base_url()?>politics/">Politics</a></li>
            <li <?php echo $active_gossip;?>><a href="<?php echo base_url()?>gossip/">Gossip</a></li>
            <li <?php echo $active_entertainment;?>><a href="<?php echo base_url()?>entertainment/">Entertainment</a></li>
            <li <?php echo $active_lifestyle;?>><a href="<?php echo base_url()?>lifestyle/">Lifestyle</a></li>
            <li <?php echo $active_weird;?>><a href="<?php echo base_url()?>weird/">Weird</a></li>
            <li <?php echo $active_video;?>><a href="<?php echo base_url()?>video/">Video</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog fa-lg"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url()?>settings"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="<?php echo base_url()?>auth/logout"><i class="fa fa-power-off"></i> <span>Sign out</span></a></li>
                
              </ul>
            </li>
          </ul>
         <!--   <form class="navbar-form navbar-right hidden-md hidden-sm hidden-xs">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>