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
		<div class="well">
			 <div class="col-sm-12" >
					<h1 class="well headline" style="margin-bottom: 10px !important;">Assesment Manager<a href="javascript:window.history.go(-1);" class="text-white pull-right m-r">Back To List</a></h1>
						<div class="col-sm-12 col-xs-12 can_details">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Name :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($performance_details['can_list']['can_name']) && !empty($performance_details['can_list']['can_name'])) ? $performance_details['can_list']['can_name'] : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Date :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($performance_details['can_list']['date']) && !empty($performance_details['can_list']['date'])) ? db_to_date($performance_details['can_list']['date']) : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Designation :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($performance_details['can_list']['role_name']) && !empty($performance_details['can_list']['role_name'])) ? $performance_details['can_list']['role_name'] : '-';?></p>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="month-head">
                            <h6>Assesment Details</h6>
                        	</div>
							
							<div class="row" style="margin-top: -10px;">
                            <div class="col-sm-12">
                                <section class="card">
                                    <div class="card-block">
                                        <table id="month_sal" class="display table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:30%">Criteria</th>
                                                    <th style="width:30%">Actual</th>
                                                    <th style="width:30%">Achieved</th>
                                                </tr>
                                            </thead>

                                        <tbody id="perform_data">
                                        <?php if(!empty(@$performance_details['assesment']) && (@$performance_details['assesment'] != NULL)) {
                                        foreach ($performance_details['assesment'] as $key => $value) { 
                                        $i++; ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo $value['criteria_name']; ?><span>*</span></label>
                                                    <input type="hidden" name="id-<?php echo $value['criteria_id']; ?>" value="<?php echo $value['id']; ?>">

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-control-wrapper form-control-icon-right">
                                                        <input class="form-control" placeholder="" type="text" name="max_value-<?php echo $value['criteria_id']; ?>" id="" value="<?php echo $value['max_value']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-control-wrapper form-control-icon-right">
                                                        <input class="form-control number val_min" placeholder="" type="text" name="assess_value-<?php echo $value['criteria_id']; ?>" required min="0" value="<?php echo $value['assess_value']; ?>" max="<?php echo $value['max_value']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                        </tbody>
                                        <input type="hidden" id="max_id" value="<?php echo $i; ?>">
                                        <input type="hidden" id="act_tot" value="0">
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
						
			</div>
		</div>
	</div>
</div>
