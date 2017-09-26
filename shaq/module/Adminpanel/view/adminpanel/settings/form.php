<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Assets Info </h2>
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
						 <input type="hidden" name="photohidden_<?php echo $this->global_locale_id; ?>" id="photohidden_<?php echo $this->global_locale_id; ?>" value="" /> 
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
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>

										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>										
											<div class="form-group">
												<label class="control-label">Asset Type<span>*</span></label>
												
													<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
														<option value="0">Select Asset Type</option>
													</select> 
											</div>
											<div class="form-group">
												<label class="control-label">Cost<span>*</span></label>
												<input type="text" class="form-control" name="cost" id="cost"/>
											</div>

										</section>
										
									</div>
									<div class="row">
										
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tax Type<span>*</span></label>
													<select class="select2" id="tax_type" name="tax_type" type="select">														
														<option value="0">Select Tax Type</option>
														<option value="Fixed">Fixed</option>
														<option value="Percent">Percent</option>
														<option value="None">None</option>
													</select> 
											</div>
										</section>	
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tax Value<span>*</span></label>
												<input type="text" class="form-control" name="tax_value" id="tax_value"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Currency<span>*</span></label>
													<select class="select2" id="currency" name="currency" type="select">														
														<option value="0">Select Currency</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Currency Exchange Rate<span>*</span></label>
													<select class="select2" id="currency_exchange_rate_id" name="currency_exchange_rate_id" type="select">														
														<option value="0">Select Currency Exchange Rate</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
												
													<label class="control-label">Photo</label>
													<div class="progress hide  progress-sm progress-striped active" style="height:40px;" id="customfileupload_<?php echo $this->global_locale_id;?>">
														<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Photo Uploading</div>
													</div>
													 
													  <div class="smart-form">
													  <label for="file" class="input input-file custombrowse">
																				<div class="button"><input type="file" name="photo_<?php echo $this->global_locale_id;?>" id="photo_<?php echo $this->global_locale_id; ?>" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Icon" readonly="" name="browseicon_<?php echo $this->global_locale_id;?>"id="browseicon_<?php echo $this->global_locale_id;?>">
													  </label>
													  </div>
													  <div>
														<img id="display_img_<?php echo $this->global_locale_id;?>" name="display_img_<?php echo $this->global_locale_id;?>" height="80px" width="120px"  class="left "/>
													  </div>
												
											</section>				
										<section class="col-md-3">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Published
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox"/>
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
										<input type="hidden" name="photohidden_<?php echo $locale['id']; ?>" id="photohidden_<?php echo $locale['id']; ?>" value="" /> 
										<div id="tabs-<?php echo $locale['id']; ?>">
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
													</div>
													<label class="control-label">Photo</label>
													<div class="progress hide progress-sm progress-striped active" style="height:40px;" id="customfileupload_<?php echo $locale['id'];?>">
														<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Photo Uploading</div>
													</div>
													 
													  <div class="smart-form">
													  <label for="file" class="input input-file custombrowse">
																				<div class="button"><input type="file" name="photo_<?php echo $locale['id']; ?>" id="photo_<?php echo $locale['id']; ?>" onchange="this.parentNode.nextSibling.value = this.value">Browse</div>
														<input type="text" placeholder="Select Icon" readonly="" name="browseicon_<?php echo $locale['id']; ?>"id="browseicon_<?php echo $locale['id']; ?>">
													  </label>
													  </div>
													  <div>
														<img id="display_img_<?php echo $locale['id']; ?>" name="display_img_<?php echo $locale['id']; ?>" height="80px" width="120px"  class="left "/>
													  </div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						</div>
					  	
					</form>
				   </div>
				   	</div>
				</div>
			 </div>
		</div>
	</div>
</section>	
								
