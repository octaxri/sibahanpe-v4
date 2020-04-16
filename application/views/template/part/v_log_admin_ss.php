<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Log Activity</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Table Log Activity</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="t4_tbl_admin">
			 <table id="tbl_log_admin" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>id_log</th>
                  <th>id_admin</th>
                  <th>tgl</th>
                  <th>referensi</th>
                  <th>aktivitas</th>				  
                </tr>
                </thead>
                
				<tbody>
				</tbody>
				
			</table>
		</div>
	</div>
	</section>
	
	
<script>

var table;

$(document).ready(function() {

    //datatables
    table = $('#tbl_log_admin').DataTable({ 
		
	"dom": 'Bfrtip<"bottom"l>',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('log_admin_ss/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
			{ 
				"targets": [ 0 ], //first column / numbering column
				"orderable": false, //set not orderable
			},
        ],
		"iDisplayLength": 50
    });

});

</script>