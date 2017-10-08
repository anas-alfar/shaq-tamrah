<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Donor Info </h2>
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
						 <input type="hidden" name="avatarhidden" id="avatarhidden" value="" />  
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name<span>*</span></label>
												<input type="text" class="form-control" name="first_name_<?php echo $this->global_locale_id; ?>" id="first_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Second Name<span>*</span></label>
												<input type="text" class="form-control" name="second_name_<?php echo $this->global_locale_id; ?>" id="second_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Third Name<span>*</span></label>
												<input type="text" class="form-control" name="third_name_<?php echo $this->global_locale_id; ?>" id="third_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Last Name<span>*</span></label>
												<input type="text" class="form-control" name="last_name_<?php echo $this->global_locale_id; ?>" id="last_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Address</label>
												<textarea type="text" id="address_<?php echo $this->global_locale_id; ?>" name="address_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Ssn<span>*</span></label>
												<input type="text" id="ssn" name="ssn" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">Title<span>*</span></label>
													<select class="select2" id="title" name="title" type="select">
													<option value="0">Select Title</option>														
														<option value="Mr.">Mr.</option>
														<option value="Mrs.">Mrs.</option>
														<option value="Miss">Miss</option>
														<option value="Ms.">Ms.</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
										   <div class="form-group ">
												<label class="control-label">&nbsp;</label>
												<label class="radio radio-inline">
													<input type="radio" class="radiobox" name="gender" id="gender1" value="Male">
													<span>Male</span> 
													
												</label>
												<label class="control-label">&nbsp;</label>
												<label class="radio radio-inline">
													<input type="radio" class="radiobox" name="gender" id="gender2" value="Female">
													<span>Female</span>  
												</label>
											</div>	
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email<span>*</span></label>
												<input type="text" id="email" name="email" class="form-control"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label>Date of Birth</label>
													<div class="input-group">
														<input type="text" name="date_of_birth" id="date_of_birth" class="form-control">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Number<span>*</span></label>
												<input type="text" id="mobile_number" name="mobile_number" class="form-control"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Number 2<span>*</span></label>
												<input type="text" id="mobile_number_2" name="mobile_number_2" class="form-control"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone Nnumber<span>*</span></label>
												<input type="text" id="phone_number" name="phone_number" class="form-control"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nationality<span>*</span></label>
												<select class="select2" id="nationality_id" name="nationality_id" type="select">
													<option value="0">Select Nationality</option>
												</select>	
											</div>
											<div class="form-group">
												<label class="control-label">Visibility<span>*</span></label>
												<select class="select2" id="visibility" name="visibility" type="select">
													<option value="0">Select Visibility</option>
													<option value="Anonymous">Anonymous</option>
													<option value="Visible">Visible</option>
												</select>	
											</div>
										</section>
										<section class="col-md-6">
											<label class="control-label">Avatar<span>*</span></label>
											<div class="progress hide  progress-sm progress-striped active" style="height:40px;" id="customfileupload">
														<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Media Uploading</div>
											</div>	
											<div class="smart-form">
												  <label for="file" class="input input-file custombrowse">
													<div class="button"><input type="file" name="avatar" id="avatar" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select File" readonly="" name="browseicon" id="browseicon">
												  </label>
											</div>
											 <div>
												<img id="display_img" name="display_img" height="80px" width="120px"  class="left "/>
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
														<label class="control-label">First Name<span>*</span></label>
														<input type="text" class="form-control" name="first_name_<?php echo $locale['id']; ?>" id="first_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Second Name<span>*</span></label>
														<input type="text" class="form-control" name="second_name_<?php echo $locale['id']; ?>" id="second_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Third Name<span>*</span></label>
														<input type="text" class="form-control" name="third_name_<?php echo $locale['id']; ?>" id="third_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Last Name<span>*</span></label>
														<input type="text" class="form-control" name="last_name_<?php echo $locale['id']; ?>" id="last_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Address</label>
														<textarea type="text" id="address_<?php echo $locale['id']; ?>" name="address_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
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
								
