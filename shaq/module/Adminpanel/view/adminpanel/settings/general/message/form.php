<section id="widForm" class="hide">	
	<div class="row" >
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Message Email Info </h2>
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
						 <form id="frmForm"  enctype="multipart/form-data" name="frmForm">
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div class="row">
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Message Type<span>*</span></label>
												<select class="select2" id="message_type_id" name="message_type_id" type="select">														
													<option value="0">Select Message Type</option>
												</select> 
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">From Name<span>*</span></label>
											<input type="text" class="form-control" name="from_name" id="from_name"/>
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
											<label class="control-label">To Name<span>*</span></label>
											<input type="text" class="form-control" name="to_name" id="to_name"/>
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
											<label class="control-label">Subject<span>*</span></label>
											<input type="text" class="form-control" name="subject" id="subject"/>
										</div>
									</section>
								</div>
								<div class="row">
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Locale<span>*</span></label>
												<select class="select2" id="locale_id" name="locale_id" type="select">														
													<option value="0">Select Locale</option>
												</select> 
										</div>
									</section>	
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Message Template<span>*</span></label>
												<select class="select2" id="message_template_id" name="message_template_id" type="select">														
													<option value="0">Select Message Template</option>
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
											<label class="control-label">Content<span></span></label>
											<textarea type="text" class="description form-control" name="email_content" id="email_content"/></textarea>
										</div>
									</section>
								</div> 
							</div>
						</form>
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>
<section id="sms_form" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Message Sms Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnSmsBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSmsSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				
				<div>
					<div class="widget-body">
						<section>
								<form id="frmFormSms" name="frmFormSms">
									<div class="panel panel-hovered panel-stacked mb30">
								<div class="row">
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Message Type<span>*</span></label>
												<select class="select2" id="message_type_id" name="message_type_id" type="select">														
													<option value="0">Select Message Type</option>
												</select> 
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">From Name<span>*</span></label>
											<input type="text" class="form-control" name="from_name" id="from_name"/>
										</div>
									</section>	
								</div>
								<div class="row">
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">From Mobile Number<span>*</span></label>
											<input type="text" class="form-control" name="from_mobile_number" id="from_mobile_number"/>
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">To Name<span>*</span></label>
											<input type="text" class="form-control" name="to_name" id="to_name"/>
										</div>
									</section>	
								</div>
								<div class="row">
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">To Mobile Number<span>*</span></label>
											<input type="text" class="form-control" name="to_mobile_number" id="to_mobile_number"/>
										</div>
									</section>
									<section class="col-md-6">
										<div class="form-group">
											<label class="control-label">Subject<span>*</span></label>
											<input type="text" class="form-control" name="subject" id="subject"/>
										</div>
									</section>
								</div>
								<div class="row">
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Locale<span>*</span></label>
												<select class="select2" id="locale_id" name="locale_id" type="select">														
													<option value="0">Select Locale</option>
												</select> 
										</div>
									</section>	
									<section class="col-md-6">			
										<div class="form-group">
											<label class="control-label">Message Template<span>*</span></label>
												<select class="select2" id="message_template_id" name="message_template_id" type="select">														
													<option value="0">Select Message Template</option>
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
											<label class="control-label">Content<span></span></label>
											<textarea type="text" class="description form-control" name="content" id="content"/></textarea>
										</div>
									</section>
								</div> 
							</div>
								</form>
							</section>
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>
								
