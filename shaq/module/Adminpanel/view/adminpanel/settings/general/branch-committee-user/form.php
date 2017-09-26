<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Branch Committee User Info </h2>
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
													<label class="control-label">Organization User Position<span>*</span></label>
													<a class="btn btnExport" id="btnUserPosition">
														<i class="fa fa-plus"></i> 
													</a>
													<select class="select2" id="organization_user_position_id" name="organization_user_position_id" type="select">
														<option value="0">Select Organization Position</option>
													</select>
													</div>
												 </section>
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Organization Branch<span>*</span></label>
														<select class="select2" id="organization_branch_id" name="organization_branch_id" type="select">
															<option value="0">Select Organization Branch</option>
														</select>
													</div>
												 </section>
											</div>
											<div class="row">
												 <section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Organization Branch Committee<span>*</span></label>
														<select class="select2" id="organization_branch_committee_id" name="organization_branch_committee_id" type="select">
															<option value="0">Select Organization Branch Committee</option>
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
											
