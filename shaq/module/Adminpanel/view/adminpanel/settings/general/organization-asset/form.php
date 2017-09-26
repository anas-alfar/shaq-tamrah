<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Organization Asset Info </h2>
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
												<label class="control-label">Asset<span>*</span></label>
												<select class="select2" id="asset_id" name="asset_id" type="select">
														<option value="0">Select Asset Id</option>
												</select>
											</div>
											 </section>
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Asset Type<span>*</span></label>
												<select class="select2" id="asset_type_id" name="asset_type_id" type="select">
														<option value="0">Select Asset Type</option>
												</select>
											</div>
											 </section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Asset Unit<span>*</span></label>
												<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">
														<option value="0">Select Asset Unit</option>
												</select>
											</div>
											 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Cost<span>*</span></label>
														<input type="text" class="form-control" name="cost" id="cost"/>
													</div>	
												 </section>
											</div>
											<div class="row">
												  <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Tax Value<span>*</span></label>
														<input type="text" class="form-control" name="tax_value" id="tax_value"/>
													</div>	
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Tax Type<span>*</span></label>
															<select class="select2" name="tax_type" id="tax_type" type="select" data-validate="true">
																<option value="0">Select Tax Type</option>
																<option value="Fixed">Fixed</option>
																<option value="Percent">Percent</option>
																<option value="None">None</option>
															</select>
													</div>	
												 </section>
										</div>
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Currency<span>*</span></label>
												<select class="select2" id="currency" name="currency" type="select">
														<option value="0">Select Currency</option>
												</select>
											</div>
											 </section>
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Currency Exchange Rate<span>*</span></label>
												<select class="select2" id="currency_exchange_rate_id" name="currency_exchange_rate_id" type="select">
														<option value="0">Select Currency Exchange Rate</option>
												</select>
											</div>
											 </section>
											</div>
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">Organization Branch<span>*</span></label>
												<select class="select2" id="organization_branch_id" name="organization_branch_id" type="select">
														<option value="0">Select Organization Branch</option>
												</select>
											</div>
											 </section>
											
												<section class="col-md-6">	
														<div class="form-group">
															<label>&nbsp;</label>
															<label class="customwidth">
																Status
																<span class="onoffswitch">															
																	<input name="status" class="onoffswitch-checkbox" id="status" type="checkbox" >
																	<label class="onoffswitch-label" for="status">
																		<span class="onoffswitch-inner" data-swchon-text="Active" data-swchoff-text="Inactive"></span> 
																		<span class="onoffswitch-switch"></span>
																	</label>
																</span>
															</label>
														</div>
													</section>
											</div>
											
								
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
											
