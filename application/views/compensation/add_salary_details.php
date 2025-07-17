
<div class="page-content">
<div>
<?php if($this->session->flashdata('success')){?>
<script type="text/javascript">
var message_text='<?php echo $this->session->flashdata('success');?>';
	$.notify({
			title: "<strong>Success:</strong> ",
			message: message_text,
		},
		{
			type: "success",
			delay: 800,
			animate:{
			enter: "animated fadeInUp",
			exit: "animated fadeOutDown"
			}
		});
</script>
<?php }?>
</div>
<div class="container-fluid">	
<div class="col-sm-12 well">
<div class="row">
<form data-toggle="validator" class="col-sm-12" name="salarydetails_form" id="salarydetails_form" action="" method="post">
<h1 class="well headline">Salary Slip Details</h1>
	<div class="col-sm-12 col-xs-12 profile_bg">
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Employee Name <span>*</span> </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="can_id" id="can_name"  style="width: 100%" required >
							<option value="" selected hidden>Select Employee Name</option>
							<?php foreach ($candidates as $key => $candidate) {?>
							<option value="<?php echo $candidate->can_id?>"><?php echo $candidate->can_name?></option>
							<?php }?>
						</select>
						<span class="msg_red" id="err_canid"></span>
					</div>		
				</div>
			</div>
			
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Date Of Joining <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control" placeholder="Date of Joining" type="text" name="joining_date" id="joining_date" readonly="">
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Designation <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control" type="text" name="can_designation" id="can_designation" value="" readonly="">
					</div>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Applicable for PF </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<label class="form-label" required="">
							<input type="radio" name="pf_applicable" value="1" checked>Yes
							<input type="radio" name="pf_applicable" value="0">No
						</label>
					</div>
				</div>
			</div>

		</div>
        
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">PF No. </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control" placeholder="Enter PF No." type="text" name="pf_no">
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">ESIC No.</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control" placeholder="ESIC No." type="text" name="esic_no">
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Gross Salary</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="Enter Gross Salary" type="text" name="gross_pay" id="gross_pay" required data-error="Please Enter Gross Salary">
						<div class="help-block with-errors error_msg"></div>			
					</div>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">PF Amount </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="Enter PF Amount" type="text" name="pf_amount" id="pf_amount" value="0" readonly>
					</div>
				</div>
			</div>							
			
		</div>

		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Income Tax </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="Enter Income Tax" type="text" name="income_tax" id="income_tax" value="0">
					</div>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Professional Tax</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="Enter Professional Tax" type="text" name="pt_amount" id="pt_amount" value="0">
					</div>
				</div>
			</div>														
		</div>

		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">ESIC Amount </label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="Enter ESIC Amount" type="text" name="esic_amount" id="esic_amount" value="0">
					</div>
				</div>
			</div>
			
		</div>

        
		<div class="month-head">
			<h6>Earnings &amp; Reimbursement </h6>
		</div>

		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Basic <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="basic" id="basic" required data-error="Please Enter Basic Salary" readonly> 
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">H.R.A <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="HRA" id="HRA" data-error="Please Enter HRA" required readonly>
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>
		</div>
        
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Conveyance <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="conveyance" id="conveyance" data-error="Please Enter Conveyance" required readonly>
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Medical <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="medical" id="medical" data-error="Please Enter Medical Allowance" required>
					</div>
					<div class="help-block with-errors error_msg"></div>			
				</div>
			</div>
		</div>
        
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
				<label class="form-label">Special Allow <span>*</span></label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="special_allowance" id="special_allowance" data-error="Please Enter Special Allowance"  required readonly>		
					</div>
						<div class="help-block with-errors error_msg"></div>	
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">LTA</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="LTA" id="LTA" >
					</div>
				</div>
			</div>
		</div>
        
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Mobile Reimbursement</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="mobile_reimbursement" id="mobile_reimbursement">
					</div>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Motor Allowance</label>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<div class="form-control-wrapper form-control-icon-right">
						<input class="form-control number" placeholder="" type="text" name="motor_allowance" id="motor_allowance">
					</div>
				</div>
			</div>
		</div>				
   

	<div class="row">
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Effective From Date <span>*</span></label>
				</div>
			</div>
		
			<div class=col-lg-4>
				<div class="date form-group">
				<div class="input-group input-append date" id="datePicker">
					<input type="text" class="form-control" name="effective_from" id="effective_from" placeholder="dd/mm/yyyy"  data-error="Please Enter Effective from Date" required/>
					<span class="input-group-addon add-on"><span  id="demo-1-button" class="glyphicon glyphicon-calendar"></span></span>
				</div>
				<div class="help-block with-errors error_msg"></div>
			</div>
			</div>
			<div class="col-lg-2">
				<div class="form-group">
					<label class="form-label">Effective To Date </label>
				</div>
			</div>
		
			<div class=col-lg-4>
				<div class="date form-group">
					<div class="input-group input-append date" id="datePicker1">
						<input type="text" class="form-control" name="effective_to" id="effective_to" placeholder="dd/mm/yyyy" />
						<span class="input-group-addon add-on"><span  id="demo-2-button" class="glyphicon glyphicon-calendar"></span></span>
					</div>
				</div>
			</div>
		</div>	                

		<div class="row">
			<div class="col-lg-6">
				<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
				<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>							
				<button class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
				<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
			</div>							
		</div>
	</div>
</form> 
</div>
</div>
</div>

</div>
<script type="text/javascript">
function formatDate (input) {
var datePart = input.match(/\d+/g),
year = datePart[0].substring(0), // get only two digits
month = datePart[1], day = datePart[2];
return day+'/'+month+'/'+year;
}
$(document).ready(function(){
// $(salarydetails_form)
// 	.bootstrapValidator({
// 		excluded: ':disabled'
// 	});

$("#datePicker,#datePicker1").datepicker( {
format: "dd/mm/yyyy"
});

var basic = 0;
var hra = 0;
var special = 0;
var pf_amount = 0;
var esic = 0;
var pt_amount = 0.0;

$(".chosen-select").chosen();

$('#can_name').change(function(){
$(this).closest('form').find("input[type=text]").val("");
var can_id = $("#can_name").chosen().val();
var response = $.parseJSON($.ajax({
url:  '<?php echo site_url();?>/compensation/get_can_details',
dataType: "json", 
data: {can_id:can_id},
type:'POST',
async: false
}).responseText);
if(response.job_profile_title != null)
{
$('#can_designation').val(response.job_profile_title);
}
else
{
$('#can_designation').val('');
}

if(response.joining_date != null)
{
$('#joining_date').val(formatDate (response.joining_date));
}
else
{
$('#joining_date').val('');
}			
});
/* Calculate salary break up on gross salary */
$('#gross_pay').change(function(){
var gross = $('#gross_pay').val();
if(gross!=''){
basic = ((35/100)*gross).toFixed(2);
hra = ((50/100)*basic).toFixed(2);
conveyance = 1600.00;
medical = 1250.00;
special = (parseFloat(gross) -(parseFloat(basic)+parseFloat(hra)+parseFloat(conveyance)+parseFloat(medical))).toFixed(2);
console.log(special);
// special = (gross - (basic + hra + conveyance + medical));
var pf_appl = $('input[name=pf_applicable]:checked').val();
if(pf_appl==1)
{
	pf_amount = ((12/100)*basic).toFixed(2);
}
else
{
	pf_amount = 0.00;
}
esic = ((1.75/100)*gross).toFixed(2);
$('#basic').val(basic);
$('#HRA').val(hra);
$('#conveyance').val(conveyance);
$('#medical').val(medical);
$('#special_allowance').val(special);
$('#pf_amount').val(pf_amount);
$('#esic').val(esic);
$('#pt_amount').val(pt_amount);
}
});

$('input[type=radio][name=pf_applicable]').change(function() {
if (this.value == 0) {
$('#pf_amount').val(0);
}
else if (this.value == 1) {
$('#pf_amount').val(pf_amount);
}
});

$('#submit_form').click(function (event) {
if($('#can_name').val()=='')
{
$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);
//event.preventDeafault();
return false;
}
});
});
</script>