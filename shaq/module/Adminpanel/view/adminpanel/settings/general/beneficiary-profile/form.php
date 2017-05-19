<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Profile Info </h2>
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
							<div class="tab-pane active panel panel-hovered panel-stacked mb20">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Description<span></span></label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control" ></textarea>
											</div>
										</section>
										
									</div>
									<div class="row">
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="details" class="onoffswitch-checkbox" id="details" type="checkbox">
														<label class="onoffswitch-label" for="details">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Details
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="family" class="onoffswitch-checkbox" id="family" type="checkbox">
														<label class="onoffswitch-label" for="family">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Family
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="family_flag" class="onoffswitch-checkbox" id="family_flag" type="checkbox">
														<label class="onoffswitch-label" for="family_flag">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Family Flag
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="income" class="onoffswitch-checkbox" id="income" type="checkbox">
														<label class="onoffswitch-label" for="income">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Income
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="spending" class="onoffswitch-checkbox" id="spending" type="checkbox">
														<label class="onoffswitch-label" for="spending">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Spending
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="home" class="onoffswitch-checkbox" id="home" type="checkbox">
														<label class="onoffswitch-label" for="home">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Home
												</label>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="asset" class="onoffswitch-checkbox" id="asset" type="checkbox">
														<label class="onoffswitch-label" for="asset">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Asset
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="asset_required" class="onoffswitch-checkbox" id="asset_required" type="checkbox">
														<label class="onoffswitch-label" for="asset_required">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Asset Required
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="education" class="onoffswitch-checkbox" id="education" type="checkbox">
														<label class="onoffswitch-label" for="education">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Education
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="medical" class="onoffswitch-checkbox" id="medical" type="checkbox">
														<label class="onoffswitch-label" for="medical">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Medical
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="medical_examination" class="onoffswitch-checkbox" id="medical_examination" type="checkbox">
														<label class="onoffswitch-label" for="medical_examination">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Medical Examination
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="disabled" class="onoffswitch-checkbox" id="disabled" type="checkbox">
														<label class="onoffswitch-label" for="disabled">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Disabled
												</label>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="volunteer" class="onoffswitch-checkbox" id="volunteer" type="checkbox">
														<label class="onoffswitch-label" for="volunteer">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Volunteer
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="gallery" class="onoffswitch-checkbox" id="gallery" type="checkbox">
														<label class="onoffswitch-label" for="gallery">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Gallery
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="research_notes" class="onoffswitch-checkbox" id="research_notes" type="checkbox">
														<label class="onoffswitch-label" for="research_notes">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Research Notes
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
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
												<label class="control-label">Beneficiary<span>*</span></label>
													<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
														<option value="0">Select Beneficiary</option>
													</select> 
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
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Description<span></span></label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control" ></textarea>
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
								
