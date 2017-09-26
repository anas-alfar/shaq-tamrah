<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Info </h2>
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
												<label class="control-label">Family Name<span>*</span></label>
												<input type="text" class="form-control" name="family_name_<?php echo $this->global_locale_id; ?>" id="family_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Family Book Number<span>*</span></label>
													<input type="text" class="form-control" name="family_book_number" id="family_book_number"/>
											</div>	
										</section>
										
										
									</div>
									<div class="row">
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Beneficiary Profile<span>*</span></label>
													<select class="select2" id="beneficiary_profile_id" name="beneficiary_profile_id" type="select">														
														<option value="0">Select Beneficiary Profile</option>
													</select> 
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Visibility
													<span class="onoffswitch">															
														<input name="visibility" class="onoffswitch-checkbox" id="visibility" type="checkbox">
														<label class="onoffswitch-label" for="visibility">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
												</label>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Intro Text<span></span></label>
												<textarea type="text" id="intro_text_<?php echo $this->global_locale_id; ?>" name="intro_text_<?php echo $this->global_locale_id; ?>" class="description form-control"  ></textarea>
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Notes<span></span></label>
												<textarea type="text"  class="description form-control" name="notes" id="notes" ></textarea>
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Options<span></span></label>
												<textarea type="text" id="options" name="options" class="description form-control" ></textarea>
											</div>
										</section>
									</div>
									<div class="row">
										
										
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
														<label class="control-label">Family Name<span>*</span></label>
														<input type="text" class="form-control" name="family_name_<?php echo $locale['id']; ?>" id="family_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Intro Text<span></span></label>
														<textarea type="text" id="intro_text_<?php echo $locale['id']; ?>" name="intro_text_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
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
<?php include("beneficiary_details.php");?>