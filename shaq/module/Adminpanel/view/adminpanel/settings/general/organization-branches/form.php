<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Organization Branch Info </h2>
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
					<div class="widget-body">
						<div id="tabs">
							<ul class="nav-tabs" id="langFormTabs">
								<li class="active">
									<a href="#tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
						 <form id="frmForm"  enctype="multipart/form-data" name="frmForm"> 
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Address</label>
												<textarea type="text" id="address_<?php echo $this->global_locale_id; ?>" name="address_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Website<span>*</span></label>
												<input type="text" class="form-control" name="website_<?php echo $this->global_locale_id; ?>" id="website_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Number<span>*</span></label>
												<input type="text" class="form-control" name="mobile_number" id="mobile_number"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Number 2<span>*</span></label>
												<input type="text" class="form-control" name="mobile_number_2" id="mobile_number_2"/>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone Number<span>*</span></label>
												<input type="text" class="form-control" name="phone_number" id="phone_number"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Fax<span>*</span></label>
												<input type="text" class="form-control" name="fax" id="fax"/>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">City<span>*</span></label>
													<select class="select2" id="city_id" name="city_id" type="select">														
														<option value="0">Select City</option>
													</select> 
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Manager<span>*</span></label>
													<select class="select2" id="manager_id" name="manager_id" type="select">														
														<option value="0">Select Manager</option>
														<option value="1">1</option>
														<option value="2">2</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Work Days<span>*</span></label>
												<input type="text" class="form-control" name="work_days" id="work_days"/>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Work Hours<span>*</span></label>
												<input type="text" class="form-control" name="work_hours" id="work_hours"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Break Hours<span>*</span></label>
												<input type="text" class="form-control" name="break_hours" id="break_hours"/>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Geo Location<span>*</span></label>
												<input type="text" class="form-control" name="geo_location" id="geo_location"/>
											</div>
										</section>
									</div>
									<div class="row">		
										<section class="col-md-6">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Is Main Branch
													<span class="onoffswitch">															
														<input name="is_main_branch" class="onoffswitch-checkbox" id="is_main_branch" type="checkbox">
														<label class="onoffswitch-label" for="is_main_branch">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
												</label>
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
								</div>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<div id="tabs-<?php echo $locale['id']; ?>">
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Address</label>
														<textarea type="text" id="address_<?php echo $locale['id']; ?>" name="address_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label">Website<span>*</span></label>
														<input type="text" class="form-control" name="website_<?php echo $locale['id']; ?>" id="website_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						</div>
					  </div>	
					</form>
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>	
								
