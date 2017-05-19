<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Message Template Info </h2>
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
												<label class="control-label">From Name<span>*</span></label>
												<input type="text" class="form-control" name="from_name_<?php echo $this->global_locale_id; ?>" id="from_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">To Name<span>*</span></label>
												<input type="text" class="form-control" name="to_name_<?php echo $this->global_locale_id; ?>" id="to_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"  ></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Subject<span>*</span></label>
												<input type="text" class="form-control" name="subject_<?php echo $this->global_locale_id; ?>" id="subject_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label">Message Type<span>*</span></label>
													<select class="select2" id="message_type_id" name="message_type_id" type="select">														
														<option value="0">Select Message</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Message For<span>*</span></label>
													<select class="select2" id="message_type" name="message_type" type="select">														
														<option value="0">Select Message For</option>
														<option value="Organization">Organization</option>
														<option value="Donor">Donor</option>
														<option value="Beneficiary">Beneficiary</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">From Mobile Number<span>*</span></label>
												<input type="number" class="form-control" name="from_mobile_number" id="from_mobile_number"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">From Email<span>*</span></label>
												<input type="text" class="form-control" name="from_email" id="from_email"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">To Mobile Number<span>*</span></label>
												<input type="number" class="form-control" name="to_mobile_number" id="to_mobile_number"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">To Email<span>*</span></label>
												<input type="text" class="form-control" name="to_email" id="to_email"/>
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
														<label class="control-label">From Name<span>*</span></label>
														<input type="text" class="form-control" name="from_name_<?php echo $locale['id']; ?>" id="from_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">To Name<span>*</span></label>
														<input type="text" class="form-control" name="to_name_<?php echo $locale['id']; ?>" id="to_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control" ></textarea>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Subject<span>*</span></label>
														<input type="text" class="form-control" name="subject_<?php echo $locale['id']; ?>" id="subject_<?php echo $locale['id']; ?>"/>
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
								
