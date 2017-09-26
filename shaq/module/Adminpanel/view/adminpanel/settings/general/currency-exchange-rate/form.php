<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Currency Exchange Rate</h2>
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
												<label class="control-label">From Currency<span>*</span></label>
								<select class="select2" id="from_currency" name="from_currency" type="select">
										<option value="0">Select From Currency</option>
								</select>
											</div>
											 </section>

												 <section class="col-md-6">
													<div class="form-group">
												<label class="control-label">To Currency<span>*</span></label>
								<select class="select2" id="to_currency" name="to_currency" type="select">
										<option value="0">Select To Currency</option>
								</select>
											</div>
											 </section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Exchange Rate<span>*</span></label>
														<input type="text" class="form-control" name="exchange_rate" id="exchange_rate"/>
													</div>
												 </section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Status<span>*</span></label>
															<select class="select2" id="status" name="status" type="select">														
																<option value="0">Select Status</option>
																<option value="Active">Active</option>
																<option value="Inactive">Inactive</option>
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
											
