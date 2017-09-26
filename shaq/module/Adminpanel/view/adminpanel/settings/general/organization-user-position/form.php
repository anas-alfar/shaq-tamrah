<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Organization User Position Info </h2>
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
												<label class="control-label">Title<span>*</span></label>
												<input type="text" class="form-control" name="title_<?php echo $this->global_locale_id; ?>" id="title_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label">Qualifications<span>*</span></label>
												<input type="text" class="form-control" name="qualifications_<?php echo $this->global_locale_id; ?>" id="qualifications_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
									</div>
								
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Responsibilities<span>*</span></label>
												<input type="text" class="form-control" name="responsibilities_<?php echo $this->global_locale_id; ?>" id="responsibilities_<?php echo $this->global_locale_id; ?>"/>
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
														<label class="control-label">Title<span>*</span></label>
														<input type="text" class="form-control" name="title_<?php echo $locale['id']; ?>" id="title_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"  placeholder=""></textarea>
													</div>
												</section>
											</div>
										
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Qualifications<span>*</span></label>
														<input type="text" class="form-control" name="qualifications_<?php echo $locale['id']; ?>" id="qualifications_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Responsibilities<span>*</span></label>
														<input type="text" class="form-control" name="responsibilities_<?php echo $locale['id']; ?>" id="responsibilities_<?php echo $locale['id']; ?>"/>
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
								
