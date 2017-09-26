<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Payment Method Configuration Info </h2>
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
														<label class="control-label">Config Key<span>*</span></label>
														<input type="text" class="form-control" name="config_key" id="config_key"/>
													</div>
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Config Value<span>*</span></label>
														<input type="text" class="form-control" name="config_value" id="config_value"/>
													</div>	
												 </section>
											</div>
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Locale<span>*</span></label>
															<select class="select2" name="locale_id" id="locale_id" type="select" data-validate="true">
																<option value="0">Select Locale</option>
															</select>
													</div>
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Environment<span>*</span></label>
															<select class="select2" name="environment" id="environment" type="select" data-validate="true">
																<option value="0">Select Environment</option>
																<option value="DEV">DEV</option>
																<option value="STG">STG</option>
																<option value="LIVE">LIVE</option>
															</select>
													</div>	
												 </section>
											</div>
											
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Payment Method<span>*</span></label>
															<select class="select2" name="payment_method_id" id="payment_method_id" type="select" data-validate="true">
																<option value="0">Select Payment Method</option>
															</select>
													</div>	
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Country<span>*</span></label>
															<select class="select2" name="country_id" id="country_id" type="select" data-validate="true">
																<option value="0">Select Country</option>
															</select>
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
											
