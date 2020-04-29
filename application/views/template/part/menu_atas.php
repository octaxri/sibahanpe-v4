  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>S</b>IBAHANPE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
		  
		   <!-- Modal -->
			  <div class="modal fade modal-success " id="myModal_admin_online" role="dialog" tabindex="-1">
				<div class="modal-dialog modal-sm">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Admin Online</h4>
					</div>
					<div class="modal-body" id="t4_all_admin_online">
					  
					  
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
					</div>
				  </div>
				</div>
			  </div>
			
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $gambar?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('NAMA');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $gambar?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('JABATAN');?> - <?php echo $this->session->userdata('OPD');?>
                  
                </p>
              </li>
             
			 
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#profil_admin" onclick="eksekusi_controller('index.php/absensi/profil_admin')" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>index.php/login/logout" class="btn btn-default btn-flat" onclick="logout();return false;">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  
 <script>
	function logout()
	{
			
				window.location.replace("<?php echo base_url()?>index.php/login/logout");
			
			
			
	}
	
 </script>
 
 
 
 </script>