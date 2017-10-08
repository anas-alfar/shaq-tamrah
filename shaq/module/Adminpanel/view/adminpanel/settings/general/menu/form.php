<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Menu Info </h2>
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
														<label class="control-label">Status<span>*</span></label>
															<select class="select2" name="status" id="status" type="select" data-validate="true">
																<option value="0">Select Status</option>
																<option value="Draft">Draft</option>
																<option value="Pending">Pending</option>
																<option value="Active">Active</option>
																<option value="Blocked">Blocked</option>
																<option value="Deleted">Deleted</option>
															</select>
													</div>	
												 </section>
										</div>
										<div class="row">
											 
											 <section class="col-md-6">
												<div class="form-group">
												<label class="control-label">Menu Category<span>*</span></label>
													<select class="select2" id="menu_category_id" name="menu_category_id" type="select">
														<option value="0">Select Menu Category</option>
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
											
