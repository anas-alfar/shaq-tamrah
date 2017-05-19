<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Configuration Info </h2>
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
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name" id="name"/>
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
														<label class="control-label">Config type<span>*</span></label>
															<select class="select2" name="config_type" id="config_type" type="select" data-validate="true">
																<option value="0">Select Config type</option>
																<option value="System">System</option>
																<option value="Website">Website</option>
																<option value="Organization">Organization</option>
																<option value="Beneficiary">Beneficiary</option>
																<option value="Donor">Donor</option>
																<option value="Payment">Payment</option>
																<option value="Agent">Agent</option>
																<option value="Project">Project</option>
																<option value="Post">Post</option>
															</select>
													</div>	
												 </section>
												 <section class="col-md-2">
													<div class="form-group">
														<label>&nbsp;</label>
														<label class="customwidth">
														Force
														<span class="onoffswitch">															
															<input name="force" class="onoffswitch-checkbox" id="force" type="checkbox">
															<label class="onoffswitch-label" for="force">
																<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																<span class="onoffswitch-switch"></span>
															</label>
														</span>
														</label>
													</div>
												 </section>
												 <section class="col-md-2">
													<div class="form-group">
													 <label>&nbsp;</label>
													 <label class="customwidth">
														Allow Override
														<span class="onoffswitch">															
															<input name="allow_override" class="onoffswitch-checkbox" id="allow_override" type="checkbox">
															<label class="onoffswitch-label" for="allow_override">
																<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																<span class="onoffswitch-switch"></span>
															</label>
														</span>
														</label>
													</div>
												 </section>
												 <section class="col-md-2">
													<div class="form-group">
													 <label>&nbsp;</label>
													  <label class="customwidth">
														Published
														<span class="onoffswitch">															
															<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
															<label class="onoffswitch-label" for="published">
																<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																<span class="onoffswitch-switch"></span>
															</label>
														</span>
														</label>
													</div>
												 </section>
												 
											</div>
											<div class="row">
												 <section class="col-md-12">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														 <textarea type="text" id="description" name="description" class="description form-control" ></textarea>
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
											
