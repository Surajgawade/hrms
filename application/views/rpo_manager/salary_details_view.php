<head>
	 <style type="text/css">
	 	table{
	 		font-family: initial;
	 		 border-collapse: collapse;
	 	}
	 td, th { 
			  text-align: left; 
			  border:1px solid #999; 
			   border-collapse: collapse;
			   padding:5px;
			}
			td:last-child {
				
				border-right: none;
			}
	 </style>
</head>
<?php if(isset($rpoempsalary_details)){ ?>
	<div class="page-content">
	<div class="container-fluid">
		<div class="well">
			<section class="card">
		  <div class="row">
		  	<div class="col-md-12" style="padding:20px 0">
		  		<center>
			<table cellpadding="4" cellspacing="0" style="border: 1px solid #999;">
				<tr>
					<td rowspan="3" style="text-align: center;"><img align="center" src="<?php echo LOGOPATH;?>" width="150px"></td>
						<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">Raoson Business & Softtech Solution</td>
				</tr>
				<tr align="center">
					<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">816, 8th Floor, DBS Business Center,The Corporate Park,<br>Sector:18, Vashi, Navi Mumbai Landline: 02227771800 Ext.814</td>
				</tr>
				<tr align="center">
					<td align="center" style="text-align: center;" colspan="3" ></td>
				</tr>
				<tr>
					<td >Employee Code:</td>
					<td ><?php echo (isset($rpoempsalary_details->can_id) && !empty($rpoempsalary_details->can_id)) ? $rpoempsalary_details->can_id : '';?></td>
					<td >Name:</td>
					<td ><?php echo (isset($rpoempsalary_details->can_name) && !empty($rpoempsalary_details->can_name)) ? $rpoempsalary_details->can_name : '';?></td>
				</tr>
				<tr>
					<td >Department</td>
					<td ><?php echo  (isset($rpoempsalary_details->department) && !empty($rpoempsalary_details->department)) ? $rpoempsalary_details->department : '';?></td>
					<td >Designation</td>
					<td ><?php echo (isset($rpoempsalary_details->designation) && !empty($rpoempsalary_details->designation)) ? $rpoempsalary_details->designation : '';?></td>
				</tr>
				
				<tr>
					<td >DOJ</td>
					<td ><?php echo (isset($rpoempsalary_details->joining_date) && !empty($rpoempsalary_details->joining_date)) ? $rpoempsalary_details->joining_date : ''; ?></td>
					<td  colspan="2" rowspan="3"></td>
				</tr>
				<tr>
					<td ><b>Per Hour Rate</b></td>
					<td colspan="3"><?php echo (isset($rpoempsalary_details->hourly_rate) && !empty($rpoempsalary_details->hourly_rate)) ? $rpoempsalary_details->hourly_rate : '';?></td>					
				</tr>
		</table>
	</center></div>
		</section>
</div>
</div>
</div>
<?php } else {?>
	<div class="row col-md-12">No records to display </div>
<?php } ?>
</div>