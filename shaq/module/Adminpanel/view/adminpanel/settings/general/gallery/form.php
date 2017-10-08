<section id="widForm" class="hide">	
	<div class="row" >
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Gallery Info </h2>
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
						 <input type="hidden" name="pathhidden" id="pathhidden" value="" />  
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Alias<span>*</span></label>
												<input type="text" class="form-control" name="alias_<?php echo $this->global_locale_id; ?>" id="alias_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>	
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Media Type<span>*</span></label>
													<select class="select2" id="media_type_id" name="media_type_id" type="select">														
														<option value="0">Select Media Type</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Media File Type<span>*</span></label>
													<select class="select2" id="media_filetype_id" name="media_filetype_id" type="select">														
														<option value="0">Select Media File Type</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Media Status<span>*</span></label>
													<select class="select2" id="media_status_id" name="media_status_id" type="select">														
														<option value="0">Select Media Status</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Beneficiary<span>*</span></label>
													<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
														<option value="0">Select Beneficiary</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Beneficiary Profile Family<span>*</span></label>
													<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
														<option value="0">Select Beneficiary Profile Family</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<label class="control-label">Media File<span>*</span></label>
											<div class="progress hide  progress-sm progress-striped active" style="height:40px;" id="customfileupload">
														<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Media Uploading</div>
											</div>	
											<div class="smart-form">
												  <label for="file" class="input input-file custombrowse">
													<div class="button"><input type="file" name="path" id="path" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select File" readonly="" name="browseicon" id="browseicon">
												  </label>
											</div>
											 <div>
												<img id="display_img" name="display_img" height="80px" width="120px"  class="left "/>
											  </div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox"/>
														<label class="onoffswitch-label" for="published">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
														Published
												</label>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Intro Text<span></span></label>
												<textarea type="text" class="description form-control" name="intro_text_<?php echo $this->global_locale_id; ?>" id="intro_text_<?php echo $this->global_locale_id; ?>"/></textarea>
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
														<label class="control-label">Alias<span>*</span></label>
														<input type="text" class="form-control" name="alias_<?php echo $locale['id']; ?>" id="alias_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Intro Text<span></span></label>
														<textarea type="text" class="description form-control" name="intro_text_<?php echo $locale['id']; ?>" id="intro_text_<?php echo $locale['id']; ?>"></textarea>
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
<section id="youtube_form" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Gallery Youtube Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnYoutubeBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnYoutubeSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				
				<div>
					<div class="widget-body">
						<div id="tabs">
							<ul class="nav nav-tabs" id="langFormIDMediaYoutubeGallery">
								<li class="active">
									<a href="#youtube-gallery-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#youtube-gallery-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
							<section>
						 	<form id="frmFormMediaYoutubeGallery" name="frmFormMediaYoutubeGallery">
							<div class="tab-content mt20">
								<div id="youtube-gallery-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Alias<span>*</span></label>
												<input type="text" class="form-control" name="alias_<?php echo $this->global_locale_id; ?>" id="alias_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>	
										<section class="col-md-6">	
											<div class="form-group">
												<label class="control-label">Youtube Link<span>*</span></label>
												<input type="text" class="form-control" name="youtube_link" id="youtube_link"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Media Status<span>*</span></label>
													<select class="select2" id="media_status_id" name="media_status_id" type="select">														
														<option value="0">Select Media Status</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Beneficiary<span>*</span></label>
													<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
														<option value="0">Select Beneficiary</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">			
											<div class="form-group">
												<label class="control-label">Beneficiary Profile Family<span>*</span></label>
													<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
														<option value="0">Select Beneficiary Profile Family</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="published_youtube" class="onoffswitch-checkbox" id="published_youtube" type="checkbox"/>
														<label class="onoffswitch-label" for="published_youtube">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
														Published
												</label>
											</div>
										</section>
									</div>
									<div class="row">	
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Intro Text<span></span></label>
												<textarea type="text" class="description form-control" name="intro_text_<?php echo $this->global_locale_id; ?>" id="intro_text_<?php echo $this->global_locale_id; ?>"/></textarea>
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
										<div id="youtube-gallery-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
											<div class="row">
												
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Alias<span>*</span></label>
														<input type="text" class="form-control" name="alias_<?php echo $locale['id']; ?>" id="alias_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Intro Text<span></span></label>
														<textarea type="text" class="description form-control" name="intro_text_<?php echo $locale['id']; ?>" id="intro_text_<?php echo $locale['id']; ?>"></textarea>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						 </form>
							</section>
						</div>
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>
								
