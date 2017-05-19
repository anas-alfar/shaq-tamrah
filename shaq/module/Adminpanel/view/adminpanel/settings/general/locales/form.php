<section id="widForm" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Locale Info </h2>
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
							<!--<input type="hidden" name="iconhidden" id="iconhidden" value="" />-->
							<fieldset>
								<div class="panel panel-hovered panel-stacked mb30">
									<div class="panel-body">
										<div class="row">
											 <section class="col-md-6">
												<div class="form-group">
													<label class="control-label">Locale<span>*</span></label>
													 <input type="text" id="locale" name="locale" class="form-control " placeholder="Locale">
												</div>
											 </section>
											 <section class="col-md-6">
												<div class="form-group">
													<label class="control-label">Name<span>*</span></label>
														 <input type="text" id="name" name="name" class="form-control " placeholder="Name">
												</div>	
											 </section>
										</div>
										<div class="row">
											 <section class="col-md-6">
												<div class="form-group">
													<label class="control-label">Locale Title<span>*</span></label>
													<input type="text" id="locale_title" name="locale_title" class="form-control " placeholder="Locale Title">
												</div>
											 </section>
											 <section class="col-md-6">
												<div class="form-group">
													<label class="control-label">Sequence<span>*</span></label>
													 <input type="number" id="sequence" name="sequence" class="form-control " placeholder="Sequence">
												</div>	
											 </section>
										</div>
									    <div class="row">
											 <section class="col-md-6">
												<div class="form-group">
													 <label class="control-label">Status<span>*</span></label>
														<select class="select2" id="status" name="status" type="select">
														<option value="0">Select Status</option>														
														<option value="Draft">Draft</option>
														<option value="Pending">Pending</option>
														<option value="Active">Active</option>
														<option value="Blocked">Blocked</option>
														<option value="Deleted">Deleted</option>
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
											 <div class="col-md-6">
											 <section class="col-md-4">
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
											 <!--<section class="col-md-6">
												
													<label class="control-label">Image</label>
													<div class="progress  progress-sm progress-striped active" style="height:30px;" id="customfileupload">
														<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Photo Uploading</div>
													</div>
													 
													  <div class="smart-form">
													  <label for="file" class="input input-file custombrowse">
																				<div class="button"><input type="file" name="image" id="image" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Icon" readonly="" name="browseicon"id="browseicon">
													  </label>
													  </div>
													  <div>
														<img id="display_img" name="display_img" height="80px" width="120px"  class="left "/>
													  </div>
												
											</section>-->				
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
										
