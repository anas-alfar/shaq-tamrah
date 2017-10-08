<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Profile Asset Required Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				
				<div>
					<div class="widget-body">
						
						 <form id="frmForm"  enctype="multipart/form-data" name="frmForm"> 
						   <div class="tab-content">
						   	  <div class="tab-pane active panel panel-hovered panel-stacked mb30">	
								<div class="row">
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Beneficiary<span>*</span></label>
												<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
													<option value="0">Select Beneficiary</option>
												</select> 
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Asset<span>*</span></label>
												<select class="select2" id="asset_id" name="asset_id" type="select">														
													<option value="0">Select Asset</option>
												</select> 
										</div>
									</section>
								</div>
								<div class="row">	
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Asset Type<span>*</span></label>
												<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
													<option value="0">Select Asset Type</option>
												</select> 
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Asset Unit<span>*</span></label>
												<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
													<option value="0">Select Asset Unit</option>
												</select> 
										</div>
									</section>
								</div>
								<div class="row">
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Asset Condition<span>*</span></label>
												<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
													<option value="0">Select Asset Condition</option>
												</select> 
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Asset Quantity<span>*</span></label>
												<input type="text" class="form-control" name="asset_quantity" id="asset_quantity"/>
										</div>	
									</section>
								</div>
								<div class="row">	
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Status<span>*</span></label>
												<select class="select2" id="status" name="status" type="select">														
													<option value="0">Select Status</option>
													<option value="Pending">Pending</option>
													<option value="Approved">Approved</option>
													<option value="Rejected">Rejected</option>
													<option value="Out of Stock">Out of Stock</option>
													<option value="Received">Received</option>
												</select>
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Beneficiary Profile Asset Received<span></span></label>
												<select class="select2" id="beneficiary_profile_asset_received_id" name="beneficiary_profile_asset_received_id" type="select">														
													<option value="0">Select Beneficiary Profile Asset Received</option>
												</select> 
										</div>
									</section>
								</div>
								<div class="row">	
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Beneficiary Profile Asset Received Date<span></span></label>
												<input type="text" class="form-control" name="beneficiary_profile_asset_received_date" id="beneficiary_profile_asset_received_date"/>
										</div>	
									</section>
								</div>
							  </div>	
							</div>
						</form>
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>	
								
