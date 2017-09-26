<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Payment Processing Fees Info </h2>
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
					<div class="jarviswidget-editbox"></div>
						<div class="widget-body no-padding"> 
							<form id="frmForm">
	
								<fieldset>
									<div class="panel panel-hovered panel-stacked mb30">
										<div class="panel-body">
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Payment Method<span>*</span></label>
								<select class="select2" id="payment_method_id" name="payment_method_id" type="select">
										<option value="0">Select Payment Method</option>
								</select>
											</div>
											 </section>
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
								<select class="select2" id="country_id" name="country_id" type="select">
										<option value="0">Select Country</option>
								</select>
											</div>
											 </section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Organization<span>*</span></label>
								<select class="select2" id="organization_id" name="organization_id" type="select">
										<option value="0">Select Organization</option>
								</select>
											</div>
											 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Fees<span>*</span></label>
														<input type="text" class="form-control" name="fees" id="fees"/>
													</div>	
												 </section>
											</div>
											<div class="row">
												  <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Currency<span>*</span></label>
														<input type="text" class="form-control" name="currency" id="currency"/>
													</div>	
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Status<span>*</span></label>
															<select class="select2" name="status" id="status" type="select" data-validate="true">
																<option value="0">Select Status</option>
																<option value="Active">Active</option>
																<option value="Inactive">Inactive</option>
															</select>
													</div>	
												 </section>
										</div>
											
											<?php /*?><div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-default" type="submit">
												<i class="fa fa-eye"></i>
												Validate
											</button>
										</div>
									</div>
								</div><?php */?>
										</div>
									</div>
										
								</fieldset>
	
								
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
</section>							
											
