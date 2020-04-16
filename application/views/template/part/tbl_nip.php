
				<div class="table-responsive">
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th width="20px">No.</th>
						<th>NIP</th>
						
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($nip as $lib)	
						{
							$no++;
							
							echo "
									<tr>
										<td>$no</td>
										<td>$lib->NIP</td>										
									</tr>
								";
									
								
						
						}
						
					?>
				</tbody>
				
			</table>
			</div>
