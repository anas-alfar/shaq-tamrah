<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Admin Authorization Rule Info </h2>
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
														<label class="control-label">Roles<span>*</span></label>
															<select class="select2" id="admin_authorization_role_id" name="admin_authorization_role_id" type="select">														
																<option value="0">Select Roles</option>
															</select> 
													</div>
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Resources<span>*</span></label>
															<select class="select2" id="authorization_resource_id" name="authorization_resource_id" type="select">														
																<option value="0">Select Resources</option>
															</select> 
													</div>
												 </section>
											</div>
											<div class="row">
												<section class="col-md-6">
													 <div class="form-group">
														<label class="control-label">Permission<span>*</span></label>
															<select class="select2" id="permission" name="permission" type="select">														
																<option value="0">Select Permission</option>
																<option value="allow">allow</option>
																<option value="deny">deny</option>
															</select> 
													 </div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Organization<span>*</span></label>
															<select class="select2" id="organization_id" name="organization_id" type="select">														
																<option value="0">Select Organization</option>
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
											
