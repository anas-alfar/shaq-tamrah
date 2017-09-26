<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Organization Info </h2>
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
						 	<input type="hidden" name="imagehidden_<?php echo $this->global_locale_id; ?>" id="imagehidden_<?php echo $this->global_locale_id; ?>" value="" />
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Organization Type<span>*</span></label>
													<select class="select2" id="organization_type_id" name="organization_type_id" type="select">														
														<option value="0">Select Organization Type</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Status<span>*</span></label>
													<select class="select2" id="status" name="status" type="select">
													<option value="0">Select Status</option>														
														<option value="Draft">Draft</option>
														<option value="Approved">Approved</option>
														<option value="In Review">In Review</option>
														<option value="Duplicate">Duplicate</option>
														<option value="Deleted">Deleted</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Notes</label>
												<textarea type="text" id="notes" name="notes" class="description form-control"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Options</label>
												<textarea type="text" id="options" name="options" class="description form-control"></textarea>
											</div>
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<label class="control-label">Logo</label>
												<div class="progress hide" style="height:21px;" id="customfileupload_<?php echo $this->global_locale_id; ?>">
												  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
												  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">
													Logo Uploading
												  </div>
												</div>
												<div class="smart-form">
													<label for="file" class="input input-file custombrowse">
														<div class="button"><input type="file" name="logo_<?php echo $this->global_locale_id; ?>" id="logo_<?php echo $this->global_locale_id; ?>" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Icon" readonly="" name="browseicon_<?php echo $this->global_locale_id; ?>"id="browseicon_<?php echo $this->global_locale_id; ?>">
														<img id="display_img_<?php echo $this->global_locale_id; ?>" name="display_img_<?php echo $this->global_locale_id; ?>" height="80px" width="120px"  class="left "/>
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
										<input type="hidden" name="imagehidden_<?php echo $locale['id']; ?>" id="imagehidden_<?php echo $locale['id']; ?>" value="" />
										<div id="tabs-<?php echo $locale['id']; ?>">
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
													</div>
												</section>
											</div>
											<div class="row">								
										<section class="col-md-6">
											<label class="control-label">Logo</label>
												<div class="progress hide" style="height:21px;" id="customfileupload_<?php echo $locale['id']; ?>">
												  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
												  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">
													Logo Uploading
												  </div>
												</div>
												<div class="smart-form">
													<label for="file" class="input input-file custombrowse">
														<div class="button"><input type="file" name="logo_<?php echo $locale['id']; ?>" id="logo_<?php echo $locale['id']; ?>" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Icon" readonly="" name="browseicon_<?php echo $locale['id']; ?>"id="browseicon_<?php echo $locale['id']; ?>">
														<img id="display_img_<?php echo $locale['id']; ?>" name="display_img_<?php echo $locale['id']; ?>" height="80px" width="120px"  class="left "/>
													</label>
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
								
