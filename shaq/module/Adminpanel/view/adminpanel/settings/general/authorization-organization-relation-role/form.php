<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Organization Relation Role Info </h2>
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
														<label class="control-label">Status<span>*</span></label>
															<select class="select2" name="status" id="status" type="select" data-validate="true">
																<option value="0">Select Status</option>
																<option value="Initiated">Initiated</option>
																<option value="Established">Established</option>
																<option value="Refused">Refused</option>
																<option value="Broken">Broken</option>
																<option value="Canceled">Canceled</option>
															</select>
													</div>	
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Admin Authorization Role<span>*</span></label>
															<select class="select2" name="admin_authorization_role_id" id="admin_authorization_role_id" type="select" data-validate="true">
																<option value="0">Select Admin Authorization Role</option>
															</select>
													</div>	
												 </section>
											</div>
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Admin Authorization Organization Relation<span>*</span></label>
															<select class="select2" name="admin_authorization_organization_relation_id" id="admin_authorization_organization_relation_id" type="select" data-validate="true">
																<option value="0">Select Admin Authorization Organization Relation</option>
																<option value="1">1</option>
																<option value="2">2</option>
															</select>
													</div>
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Organization<span>*</span></label>
															<select class="select2" name="organization_id" id="organization_id" type="select" data-validate="true">
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
											
