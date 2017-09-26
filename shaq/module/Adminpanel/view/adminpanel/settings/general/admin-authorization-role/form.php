<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Admin Authorization Role Info </h2>
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
														<label class="control-label">Type<span>*</span></label>
															<select class="select2" id="type" name="type" type="select">														
																<option value="0">Select Type</option>
																<option value="Default">Default</option>
																<option value="Custom">Custom</option>
																<option value="Temp">Temp</option>
																<option value="Relation">Relation</option>
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
											
