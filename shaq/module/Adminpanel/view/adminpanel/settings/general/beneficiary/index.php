<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>Beneficiary Settings</li>
		<li>Beneficiaries</li>
	</ol>
	<!-- end breadcrumb -->
	<!--<span class="ribbon-button-alignment pull-right" style="margin-right:25px">
		<a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
		<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
		<button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
	</span> -->
</div>
<!-- END RIBBON -->
<!-- #MAIN CONTENT -->
<div id="content">
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
				<?php include("grid.php");?> 
				<?php include("form.php");?> 
				<?php include("view.php");?> 
			</article>
		</div>
	</section>
</div>					
<!-- END #MAIN CONTENT -->

<div id="ImportCsvFileModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Import beneficiary</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/beneficiary', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
					</div>
				</section>
			</fieldset>			
		 </form>
		 
		 <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="importsavebutton" id="importsavebutton"><i class="fa fa-cloud-download"></i>&nbsp;Import</button>	
         </div>
      </div>
   </div>
</div>
<!---------------------------------Donation Form Start-------------------------------------------------------->
<div id="DonationModal" class="modal fade bs-example-modal-lg" style="overflow-y: scroll;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_name"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>New Donation</h2>
					<div class="widget-toolbar">
								
								<button id="btnDonationBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnDonationSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormDonation"  enctype="multipart/form-data" name="frmFormDonation"> 
						 
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Beneficiary Profile Asset Received</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset<span>*</span></label>
																			<select class="select2" id="asset_id" name="asset_id" type="select">														
																				<option value="0">Select Asset</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Type<span>*</span></label>
																			<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
																				<option value="0">Select Asset Type</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Unit<span>*</span></label>
																			<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
																				<option value="0">Select Asset Unit</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Quantity<span>*</span></label>
																		<input type="text" class="form-control" name="asset_quantity" id="asset_quantity"/>
																	</div>
																 </section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Condition<span>*</span></label>
																			<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
																				<option value="0">Select Asset Condition</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Value<span>*</span></label>
																		<input type="text" class="form-control" name="asset_value" id="asset_value"/>
																	</div>
																 </section>
															</div>
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Receipt Number<span>*</span></label>
																		<input type="text" class="form-control" name="receipt_number" id="receipt_number"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Donor<span>*</span></label>
																			<select class="select2" id="donor_id" name="donor_id" type="select">														
																				<option value="0">Select Donor</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Payment</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Hash ID<span>*</span></label>
																			<select class="select2" id="hash_id" name="hash_id" type="select">														

																				<option value="0">Select Hash ID</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency<span>*</span></label>
																			<select class="select2" id="currency" name="currency" type="select">														
																				<option value="0">Select currency</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Amount<span>*</span></label>
																		<input type="text" class="form-control" name="amount" id="amount"/>
																	</div>
																 </section>		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Status<span>*</span></label>
																			<select class="select2" id="status" name="status" type="select">														
																				<option value="0">Select Status</option>
																				<option value="Initiated">Initiated</option>
																				<option value="success">Success</option>
																				<option value="failed">Failed</option>
																				<option value="uncertain">Uncertain</option>
																			</select> 
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
																		<label class="control-label">Payment Method<span>*</span></label>
																			<select class="select2" id="payment_method_id" name="payment_method_id" type="select">														
																				<option value="0">Select Payment Method</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Payment Offline Details</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Received By<span>*</span></label>
																		<input type="text" class="form-control" name="received_by" id="received_by"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Collection Currency<span>*</span></label>
																		<select class="select2" id="collection_currency" name="collection_currency" type="select">
																			<option value="0">Select Collection Currency</option>
																		</select>	
																	</div>
																 </section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Date of Collection<span></span></label>
																		<input type="text" class="form-control" name="date_of_collection" id="date_of_collection"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Collection Type<span>*</span></label>
																			<select class="select2" id="collection_type" name="collection_type" type="select">														
																				<option value="0">Select Collection Type</option>
																				<option value="Cash">Cash</option>
																				<option value="Check">Check</option>
																				<option value="Machine">Machine</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">	
											<header>
												<h2>Transaction</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-4">
																	<div class="form-group">
																		<label class="control-label">Transaction Date<span></span></label>
																		<input type="text" class="form-control" name="insertion_date" id="insertion_date"/>
																	</div>
																 </section>
																<section class="col-md-4">
																	<div class="form-group">
																		<label class="control-label">Transaction Type<span>*</span></label>
																			<select class="select2" id="transaction_type_id" name="transaction_type_id" type="select">														
																				<option value="0">Select Debit Credit Flag</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-4">
																	<div class="form-group">
																		<label class="control-label">Description<span></span></label>
																		<textarea type="text" class="form-control description" name="description" id="description"></textarea>
																	</div>
																 </section>		
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">	
											<header>
												<h2>Transaction Entries</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Transaction Entry Seq<span>*</span></label>
																		<input type="text" class="form-control" name="transaction_entry_seq" id="transaction_entry_seq"/>
																	</div>
																 </section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Debit Credit Flag<span>*</span></label>
																			<select class="select2" id="debit_credit_flag" name="debit_credit_flag" type="select">														
																				<option value="0">Select Debit Credit Flag</option>
																				<option value="D">D</option>
																				<option value="C">C</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">	
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Transaction Amount<span></span></label>
																		<input type="text" class="form-control" name="transaction_amount" id="transaction_amount"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Transaction Date<span></span></label>
																		<input type="text" class="form-control" name="transaction_date" id="transaction_date"/>
																	</div>
																 </section>
															</div>
															<div class="row"> 	
																  <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Posting Date<span></span></label>
																		<input type="text" class="form-control" name="posting_date" id="posting_date"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Gl Account<span>*</span></label>
																			<select class="select2" id="gl_account_id" name="gl_account_id" type="select">														
																				<option value="0">Select Gl Account</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>
<!---------------------------------Donation Form End-------------------------------------------------------->
<!---------------------------------Sponsorship Form Start-------------------------------------------------------->
<div id="SponsorshipModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_spon"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Sponsorship</h2>
					<div class="widget-toolbar">
								
								<button id="btnSponsorshipBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSponsorshipSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
								<button id="btnNewDonation" type="submit" class="right btn btn-danger   addEventBtn " data-dismiss="modal">
									   <i class="fa fa-gift"></i> &nbsp;New Donation
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormSponsorship"  enctype="multipart/form-data" name="frmFormSponsorship">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
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
												<label class="control-label">Donor<span>*</span></label>
												<a class="btn btnExport" id="btnDonor">
														<i class="fa fa-plus" ></i> 
													</a>
													<select class="select2" id="donor_id" name="donor_id" type="select">														
														<option value="0">Select Donor</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Frequency<span>*</span></label>
													<select class="select2" id="frequency" name="frequency" type="select">														
														<option value="0">Select Frequency</option>
														<option value="One Time">One Time</option>
														<option value="Daily">Daily</option>
														<option value="Weekly">Weekly</option>
														<option value="Monthly">Monthly</option>
														<option value="Quarterly">Quarterly</option>
														<option value="Annual">Annual</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Amount<span>*</span></label>
												<input type="text" class="form-control" name="amount" id="amount"/>
											</div>
										 </section>
									</div>
									<div class="row">
										  <section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Currency<span>*</span></label>
													<select class="select2" id="currency" name="currency" type="select">														
														<option value="0">Select currency</option>
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
											<div class="form-group">
												<label class="control-label">Status<span>*</span></label>
													<select class="select2" id="status" name="status" type="select">														
														<option value="0">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select> 
											</div>
										</section>
									</div>
								</div>
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>
<div id="DonorModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_spon"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Donor</h2>
					<div class="widget-toolbar">
								
								<button id="btnDonorBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnDonorSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body">
						<div id="tabsDonor">
							<ul class="nav-tabs" id="langFormTabs">
								<li class="active">
									<a href="#tabsDonor-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#tabsDonor-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
						 <form id="frmFormDonor"  enctype="multipart/form-data" name="frmFormDonor">
						 <input type="hidden" name="avatarhidden" id="avatarhidden" value="" />  
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabsDonor-<?php echo $this->global_locale_id; ?>">
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
												<label class="control-label">Date of Birth<span></span></label>
												<input type="text" class="form-control" name="date_of_birth1" id="date_of_birth1"/>
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
										<div id="tabsDonor-<?php echo $locale['id']; ?>">
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
	  </div>
    </div>
</div>
<!---------------------------------Sponsorship Form End-------------------------------------------------------->
<!---------------------------------Manage Groups Form Start-------------------------------------------------------->
<div id="ManageGroupsModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_manage"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Manage Groups</h2>
					<div class="widget-toolbar">
								
								<button id="btnManageGroupsBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnManageGroupsSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormManageGroups"  enctype="multipart/form-data" name="frmFormManageGroups">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Beneficiary Group<span>*</span></label>
													<select class="select2" id="beneficiary_group_id" name="beneficiary_group_id" type="select">														
														<option value="0">Select Beneficiary Group</option>
													</select> 
											</div>
										</section>
									</div>
								</div>
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>
<!---------------------------------Manage Groups Form End-------------------------------------------------------->
<!---------------------------------Manage Asset Form Start-------------------------------------------------------->
<div id="ManageAssetModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_asset"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Manage Assets</h2>
					<div class="widget-toolbar">
								
								<button id="btnManageAssetBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnManageAssetSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormManageAsset"  enctype="multipart/form-data" name="frmFormManageGroups">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset<span>*</span></label>
													<select class="select2" id="asset_id" name="asset_id" type="select">														
														<option value="0">Select Asset</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset Type<span>*</span></label>
													<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
														<option value="0">Select Asset Type</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset Unit<span>*</span></label>
													<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
														<option value="0">Select Asset Unit</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset Condition<span>*</span></label>
													<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
														<option value="0">Select Asset Condition</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset Quantity<span>*</span></label>
													<input type="text" class="form-control" name="asset_quantity" id="asset_quantity"/>
											</div>	
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Status<span>*</span></label>
													<select class="select2" id="status" name="status" type="select">														
														<option value="0">Select Status</option>
														<option value="Pending">Pending</option>
														<option value="Approved">Approved</option>
														<option value="Rejected">Rejected</option>
														<option value="Out of Stock">Out of Stock</option>
														<option value="Received">Received</option>
													</select>
											</div>
										</section>	
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Beneficiary Profile Asset Received<span>*</span></label>
													<select class="select2" id="beneficiary_profile_asset_received_id" name="beneficiary_profile_asset_received_id" type="select">														
														<option value="0">Select Beneficiary Profile Asset Received</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Beneficiary Profile Asset Received Date<span></span></label>
													<input type="text" class="form-control" name="beneficiary_profile_asset_received_date" id="beneficiary_profile_asset_received_date"/>
											</div>	
										</section>
									</div>
								</div>
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>
<!---------------------------------Manage Asset Form End-------------------------------------------------------->
<!---------------------------------Change Organization Form Start-------------------------------------------------------->
<div id="ChangeOrganizationModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
		 		<b><span id="beneficiary_organization"></span></b>	
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Change Organization</h2>
					<div class="widget-toolbar">
								
								<button id="btnChangeOrganizationBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnChangeOrganizationSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormChangeOrganization"  enctype="multipart/form-data" name="frmFormChangeOrganization">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Target Organization<span>*</span></label>
													<select class="select2" id="target_organization_id" name="target_organization_id" type="select">														
														<option value="0">Select Target Organization</option>
													</select> 
											</div>
										</section>
									</div>
								</div>
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>
<!---------------------------------Change Organization Form End-------------------------------------------------------->


<script type="text/javascript">
		var gridData = [];
		var beneficiaryID;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'list'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridData = data.aaData;
					$("#tblMasterList").find("tbody").html("");
					oTable.clear().draw();
					oTable.rows.add(gridData); // Add new data
					oTable.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}
		function fetch_beneficiary_profile_family(objFormData)
		{
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'beneficiaryprofilefamily'));?>",objFormData);
			$('#BeneficiaryProfileListId').html(objMyPost.DATA.beneficiary_profile_list);				
		}	
		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#family_book_number").val(), 'beneficiary', "family_book_number", "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Family Book Nnumber  is Already exists !', 0);
				return false;
			}
			
			var $form = $('#frmForm');
			var objMasterData = $form.serializeObject();
			if (strActionMode == 'ADD')
				$.extend(objMasterData, { MASTER_KEY_ID: 0});
			else
				$.extend(objMasterData, { MASTER_KEY_ID: iActiveID});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'beneficiary Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					beneficiaryID =  objMyPost.DATA.MY_ID;
					visibleControl('widForm', false);
					showProfileDetailTabs(objMyPost.DATA.ALLOWED_PROFILE_LIST);
					visibleControl('widFormDetail', true);
					fetch_grid_data();
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}
		/************************************Donation Save Start*****************************************/
		function savefrmFormDonationData()  {
			
			
			var $form = $('#frmFormDonation');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/donation', array('action'=>'savenewdonation'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Donation Entry Saved successfully', 1);
					$('#DonationModal').modal('hide');
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}	
		}		
		/************************************Donation Save End*****************************************/
		/************************************Sponsorship Save Start*****************************************/
		function savefrmFormSponsorshipData()  {
			
			
			var $form = $('#frmFormSponsorship');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savesponsorship'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Sponsorship Entry Saved successfully', 1);
					$('#SponsorshipModal').modal('hide');
					
				}
			}	
		}
		function savefrmFormDonorData()  {
			var first_name=$('#frmFormDonor').find("#first_name_<?php echo $this->global_locale_id; ?>").val();
			var isDuplicate = fn_validate_duplicate(first_name, 'donor_locale', "first_name", "<?php echo $this->url('adminpanel/donor', array('action'=>'validateduplicate'));?>",0);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. First Name is Already exists !', 0);
				return false;
			}
			var $form = $('#frmFormDonor');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/donor', array('action'=>'savedonor'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Donor Entry Saved successfully', 1);
					$('#DonorModal').modal('hide');
					var donor=$("#frmFormSponsorship").find("#donor_id");
					var donor_array=[donor];		
					populateOptionValuesDonorBulk(donor_array,"<?php echo $this->url('adminpanel/donor', array('action'=>'getdonor'));?>","Select Donor");
				}
			}	
		}		
		/************************************Sponsorship Save End*****************************************/
		/************************************Manage Groups Save Start*****************************************/
		function savefrmFormManageGroupsData()  {
			
			
			var $form = $('#frmFormManageGroups');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savemanagegroups'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Manage Groups Entry Saved successfully', 1);
					$('#ManageGroupsModal').modal('hide');
				}
			}	
		}		
		/************************************Manage Groups Save End*****************************************/
		/************************************Manage Asset Save Start*****************************************/
		function savefrmFormManageAssetData()  {
			
			
			var $form = $('#frmFormManageAsset');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary-profile-asset-required', array('action'=>'savemanageasset'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Manage Asset Entry Saved successfully', 1);
					$('#ManageAssetModal').modal('hide');
				}
			}	
		}		
		/************************************Manage Asset Save End*****************************************/
		/************************************Change Organization Save Start*****************************************/
		function savefrmFormChangeOrganizationData()  {
			
			
			var $form = $('#frmFormChangeOrganization');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savechangeorganization'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Manage Groups Entry Saved successfully', 1);
					$('#ChangeOrganizationModal').modal('hide');
				}
			}	
		}		
		/************************************Change Organization Save End*****************************************/
		var pagefunction = function() { 
		$('#tabs').tabs();
		$('#tabs1').tabs();
		$('#tabsDonor').tabs();
		

			var responsiveHelper_tblMasterList = undefined;			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};
			oTable = $('#tblMasterList').DataTable({
				"bLengthChange": true,
				"bAutoWidth": true,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"bProcessing": false,
                "bServerSide": false,
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "autoWidth" : true,		
				"autoWidth" : true,
				"preDrawCallback" : function() {
					if (!responsiveHelper_tblMasterList) {
						responsiveHelper_tblMasterList = new ResponsiveDatatablesHelper($('#tblMasterList'), breakpointDefinition);
						
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					grid_tooltip();
					responsiveHelper_tblMasterList.respond();
				},	
				"aaData": gridData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false }, 
					{
						"class":          'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
					},                   
                    null,
                    null,
					null,
					null,
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'visibility',full[6],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_beneficiary(full[0],full[2]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [6] }
                ]	
			});
			$('#tblMasterList tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = oTable.row( tr );
				
				if ( row.child.isShown() ) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				}
				else if(tr.hasClass('loaded'))
				{
					row.child.show();
					tr.addClass('shown');
				}				
				else {
					tr.addClass('loading');
					var KEY_ID = $(this).parent().find('input[name="gridHiddenIdArray[]"]').val();
					var returnData;
					hideShowLoader(true);
					$.ajax({
					  type: "POST",
					  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getgriddetailslist'));?>",
					  data:{'KEY_ID':KEY_ID},
					  dataType: "json",
					  success: function(data){
							hideShowLoader(false);
							row.child(data.grid_list).show();
							tr.addClass('loaded');
							tr.removeClass('loading');
							tr.addClass('shown');
					  }
					});
					
				}
			});				
			$("#tblMasterList thead th input[type=text]").on( 'keyup change', function () {	    	
				oTable
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );
			$("#tblMasterList thead th select").on( 'change', function () {				
				var matchValue = this.value					    	    	
				oTable
					.column( $(this).parent().index()+':visible' )
					.search(matchValue)
					.draw();	            
			} );	
			
			$('#frmForm').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				country_id: {
                    validators: {
                       callback: {
                            message: 'Please select country',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				beneficiary_profile_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				sequence : {
					validators : {
						notEmpty : {
							message : 'Please enter sequence'
						}
					}
				},
				family_book_number : {
					validators : {
						notEmpty : {
							message : 'Please enter family book number'
						}
					}
				},
				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						family_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter family name'						
								}
							}
						},
						<?php 
					} 
				?>
				
				
			}
		}) 
		 .on('status.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
			var $form     = $(e.target),
                validator = data.bv,
                $tabPane  = data.element.parents('.ui-tabs-panel'),
                tabId     = $tabPane.attr('id');
			//$tabPane.attr('id','232323');
            
            if (tabId) {				
                var $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
                // Add custom class to tab containing the field
                if (data.status == validator.STATUS_INVALID) {
                    $icon.removeClass('fa-check').addClass('fa-times');
                } else if (data.status == validator.STATUS_VALID) {
                    var isValidTab = validator.isValidContainer($tabPane);
                    $icon.removeClass('fa-check fa-times')
                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
                }
            }
			
        })
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormData();
		});
		/************************************Donation Validation Start*****************************************/
		$('#frmFormDonation').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				asset_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_unit_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset unit',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_quantity: {
					validators: {
						notEmpty : {
							message : 'Please enter asset quantity'						
						},
						numeric: {
							message: 'The asset quantityr is not valid',
							decimalSeparator: '.'
						}
					}
				},
				asset_condition_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset condition ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_value: {
					validators: {
						notEmpty : {
							message : 'Please enter asset value'						
						},
						numeric: {
							message: 'The asset value is not valid',
							decimalSeparator: '.'
						}
					}
				},
				receipt_number : {
					validators : {
						notEmpty : {
							message : 'Please enter receipt number'
						}
					}
				},
				currency: {
                    validators: {
                       callback: {
                            message: 'Please select currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				donor_id: {
                    validators: {
                       callback: {
                            message: 'Please select donor ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				
				amount: {
					validators: {
						notEmpty : {
							message : 'Please enter amount'						
						},
						numeric: {
							message: 'The amount is not valid',
							decimalSeparator: '.'
						}
					}
				},
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				payment_method_id: {
                    validators: {
                       callback: {
                            message: 'Please select payment method ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				country_id: {
                    validators: {
                       callback: {
                            message: 'Please select country',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				received_by : {
					validators : {
						notEmpty : {
							message : 'Please enter received by'
						}
					}
				},
				collection_currency: {
                    validators: {
                       callback: {
                            message: 'Please select collection currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				collection_type: {
                    validators: {
                       callback: {
                            message: 'Please select collection type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select transaction type ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_entry_seq: {
					validators: {
						notEmpty : {
							message : 'Please enter transaction entry seq'						
						},
						numeric: {
							message: 'The transaction entry seq is not valid',
						}
					}
				},
				debit_credit_flag: {
                    validators: {
                       callback: {
                            message: 'Please select debit credit flag',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_amount: {
					validators: {
						notEmpty : {
							message : 'Please enter transaction amount'						
						},
						numeric: {
							message: 'The transaction amount is not valid',
						}
					}
				},
				gl_account_id: {
                    validators: {
                       callback: {
                            message: 'Please select gl account ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                }
				
			}
		})
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormDonationData();
		});
		/************************************Donation Validation End*****************************************/
		
		/************************************Sponsorship Validation Start*****************************************/
		$('#frmFormSponsorship').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_profile_family_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile family',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				frequency: {
                    validators: {
                       callback: {
                            message: 'Please select frequency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				currency: {
                    validators: {
                       callback: {
                            message: 'Please select currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				currency_exchange_rate_id: {
                    validators: {
                       callback: {
                            message: 'Please select currency exchange rate ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				amount: {
					validators: {
						notEmpty : {
							message : 'Please enter amount'						
						},
						numeric: {
							message: 'The amount is not valid',
							decimalSeparator: '.'
						}
					}
				},
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                }
				
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormSponsorshipData();
		});
		$('#frmFormDonor').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				nationality_id: {
                    validators: {
                       callback: {
                            message: 'Please select nationality',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				
				title: {
                    validators: {
                       callback: {
                            message: 'Please select title',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				email : {
					validators : {
						notEmpty : {
							message : 'Please enter from email'						
						},
						emailAddress: {
							message : 'Please enter valide email'						
						}
					}
				},
				visibility: {
                    validators: {
                       callback: {
                            message: 'Please select visibility',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				ssn : {
					validators : {
						notEmpty : {
							message : 'Please enter ssn'						
						}
					}
				},
				mobile_number : {
					validators : {
						notEmpty : {
							message : 'Please enter mobile number'						
						},
						digits : {
							message : 'The mobile number is not valid'
						}
					}
				},
				mobile_number_2 : {
					validators : {
						notEmpty : {
							message : 'Please enter mobile number 2'						
						},
						digits : {
							message : 'The mobile number 2 is not valid'
						},
						callback: {
                            message: 'Minimum 12 digit and maximum 14 digit allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length>=12&&value.length<=14);
                            }
                        }
                        
					}
				},
				phone_number : {
					validators : {
						notEmpty : {
							message : 'Please enter phone number'						
						},
						digits : {
							message : 'The phone number is not valid'
						},
						callback: {
                            message: 'Minimum 12 digit and maximum 14 digit allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length>=12&&value.length<=14);
                            }
                        }
					}
				},

				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						first_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter first name'						
								}
							}
						},
						second_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter second name'						
								}
							}
						},
						third_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter third name'						
								}
							}
						},
						last_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter last name'						
								}
							}
						},
						<?php 
					} 
				?>
				
			}
		}) 
		 .on('status.field.bv', function(e, data) {

            console.log('error.field.bv -->', data);
			var $form     = $(e.target),
                validator = data.bv,
                $tabPane  = data.element.parents('.ui-tabs-panel'),
                tabId     = $tabPane.attr('id');
			//$tabPane.attr('id','232323');
            
            if (tabId) {				
                var $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
                // Add custom class to tab containing the field
                if (data.status == validator.STATUS_INVALID) {
                    $icon.removeClass('fa-check').addClass('fa-times');
                } else if (data.status == validator.STATUS_VALID) {
                    var isValidTab = validator.isValidContainer($tabPane);
                    $icon.removeClass('fa-check fa-times')
                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
                }
            }
			
        })
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormDonorData();
		});
		/************************************Sponsorship Validation End*****************************************/
		/************************************Manage Groups Validation Start*****************************************/
		$('#frmFormManageGroups').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_group_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary group ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                }
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormManageGroupsData();
		});
		/************************************Manage Groups Validation End*****************************************/
		
		/************************************Manage Groups Validation Start*****************************************/
		$('#frmFormManageAsset').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				asset_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset type ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_unit_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset unit ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_quantity: {
					validators: {
						notEmpty : {
							message : 'Please enter  asset quantity'						
						},
						numeric: {
							message: 'The asset quantity is not valid',
							decimalSeparator: '.'
						}
					}
				},
				asset_condition_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset condition ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                }
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormManageAssetData();
		});
		/************************************Manage Groups Validation End*****************************************/
		/************************************Change Organization Validation Start*****************************************/
		$('#frmFormChangeOrganization').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				target_organization_id: {
                    validators: {
                       callback: {
                            message: 'Please select target organization ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                }
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormChangeOrganizationData();
		});
		$("#frmFormDonor").find("#avatar").change(function () {
			if (this.files && this.files[0]) {
			  var reader = new FileReader();
			  reader.readAsDataURL(this.files[0]);
			  var $form = $('#frmFormDonor');
			  var oMyForm = new FormData($form.get(0));
			   //*============================image=====================================
			  file = document.getElementById("avatar").files[0];
			  if (file && file.size > 0) {
			  var fileInputProfile = document.getElementById("avatar");
			  oMyForm.append("avatar", file);
			  } else {
				oMyForm.append("avatar", 0);
			  }
			
			
			   var deferred;
			   deferred = $.ajax({
			
				url: "<?php echo $this->url('adminpanel/donor', array('action'=>'uploadavatar'));?>",
				type: "POST",
				processData: false,
				contentType: false,
				dataType: 'json',
				data: oMyForm,
				beforeSend: function () {
			
				},
				success: function () {
					
				}
			
			   });
			
				$("#frmFormDonor").find("#customfileupload").removeClass('hide');
				$("#frmFormDonor").find("#btnDonorSave").addClass('hide');
				
			   deferred.done(function (result) {
			   
				$("#frmFormDonor").find("#avatarhidden").val(result.avatar);
				$("#frmFormDonor").find("#customfileupload").addClass('hide');
				$("#frmFormDonor").find("#btnDonorSave").removeClass('hide');
				$("#frmFormDonor").find("#display_img").removeClass('hide');
				$("#frmFormDonor").find("#display_img").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.avatar);
				mySmallAlert('Avatar','successfully uploaded.', 1);
				}).fail(function (result) {
				alert("There was an error");
			   });
			  }
			
			 });
		/************************************Change Organization Validation End*****************************************/
			
		fnBulkSave("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'delete'));?>");
		fnDonation(); 
		fnSponsorship("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getFamilyDetail'));?>"); 
		fnManageGroups("<?php echo $this->url('adminpanel/group', array('action'=>'getmanagegroup'));?>");
		fnManageAsset("<?php echo $this->url('adminpanel/beneficiary-profile-asset-received', array('action'=>'getassetreceived'));?>");
		fnChangeOrganization();
		fnViewBeneficiary();	
		fetch_grid_data();	
			
		loadJsForDetailForm();		
		
		}
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/jquery.dataTables.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.colVis.min.js", function(){
				loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.tableTools.min.js", function(){
					loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
							loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction)
						});	
					});
				});
			});
		});
</script>
<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">	
	hideShowLoaderActive(true);	
	$(document).ready(function () {
		/************************ VIEW.PHP FILE EVENT START **************************************/
		$("#btnViewBack").click(function (e) {
			e.stopPropagation();
			fullscreenModeChange('btnBack');
			visibleControl("widForm", false);
			visibleControl("widViewBeneficiary", false);
			visibleControl("widGrid", true);
	
		});
		/************************ VIEW.PHP FILE EVENT END **************************************/
		/************************ STEP BACK ACCESS EVEN **************************************/ 		
		$("#btnBackFromSteps").click(function(){
			visibleControl('widFormDetail', false);
			visibleControl('widGrid', true);
		});
		/*********************************Donation Click Event Start*******************************************/
		 $("#btnDonationSave").click(function(){
				$("#frmFormDonation").submit();
		});	
		$("#btnDonationBack").click(function (e) {
			$('#DonationModal').modal('hide');
		});
		/*********************************Donation Click Event End*******************************************/   
		/*********************************Sponsorship Click Event Start*******************************************/
		 $("#btnSponsorshipSave").click(function(){
				$("#frmFormSponsorship").submit();
		});	
		$("#btnSponsorshipBack").click(function (e) {
			$('#SponsorshipModal').modal('hide');
		});
		$("#btnDonor").click(function (e) {
			clearForm('frmFormDonor');
			$('#frmFormDonor').bootstrapValidator("resetForm",true);
			$('#DonorModal').modal('show');
		});
		$("#btnDonorSave").click(function(){
				$("#frmFormDonor").submit();
		});
		$("#btnDonorBack").click(function (e) {
			$('#DonorModal').modal('hide');
		});	
		$("#btnNewDonation").click(function (e) {
			var beneficiaryID=$(this).attr("row-id");
			var ben_name=$(this).attr("row-name");
			$("#frmFormDonation").find('#beneficiary_id').val(beneficiaryID);
			$('#DonationModal').modal('show');
			clearForm('frmFormDonation');
			$('#frmFormDonation').bootstrapValidator("resetForm",true);
			$("#beneficiary_name").html(ben_name);
			$('#DonorModal').modal('hide');
		});	
		/*********************************Sponsorship Click Event End*******************************************/
		/*********************************Manage Groups Click Event Start*******************************************/
		 $("#btnManageGroupsSave").click(function(){
				$("#frmFormManageGroups").submit();
		});
		$("#btnManageGroupsBack").click(function (e) {
			$('#ManageGroupsModal').modal('hide');
		});	
		/*********************************Manage Groups Click Event End*******************************************/
		/*********************************Manage Assets Click Event Start*******************************************/
		 $("#btnManageAssetSave").click(function(){
				$("#frmFormManageAsset").submit();
		});
		$("#btnManageAssetBack").click(function (e) {
			$('#ManageAssetModal').modal('hide');
		});	
		/*********************************Manage Assets Click Event End*******************************************/   
		/*********************************Change Organization Click Event Start*******************************************/
		 $("#btnChangeOrganizationSave").click(function(){
				$("#frmFormChangeOrganization").submit();
		});
		$("#btnChangeOrganizationBack").click(function (e) {
			$('#ChangeOrganizationModal').modal('hide');
		});	
		/*********************************Change Organization Click Event End*******************************************/   
		
		var donation_country=$("#frmFormDonation").find("#country_id");
		var family_country=$("#frmFamilyDetail").find("#country_id");
		var frmForm_country=$("#frmForm").find("#country_id");
		var country_array=[frmForm_country,family_country,donation_country];		
		populateOptionValuesBulk(country_array,"<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		frmForm_country.change(function()
		{
			var country_id =$(this).val();
			
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				
				populateDependentOptionValues("beneficiary_profile_id","<?php echo $this->url('adminpanel/beneficiary-profile', array('action'=>'getprofilefamily'));?>","Select Beneficiary Profile",objFormData);
			}
		});
		
		
		$("#edu_start_at").datepicker();
		
/*********************************Donation Click populate Start*******************************************/
		$("#date_of_collection").datepicker();
		$("#insertion_date").datepicker();
		$("#transaction_date").datepicker();
		$("#posting_date").datepicker();
		
		
		var currency=$("#frmFormDonation").find("#currency");
		var collection_currency=$("#frmFormDonation").find("#collection_currency");
		var currency_array=[currency,collection_currency];
		populateOptionValuesBulk(currency_array,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		
		
		var payment_method=$("#frmFormDonation").find("#payment_method_id");
		var payment_method_array=[payment_method];
		donation_country.change(function()
		{
			var country_id =$(this).val();
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				populateDependentOptionValuesObjectBulk(payment_method_array,"<?php echo $this->url('adminpanel/payment-method', array('action'=>'getpayment'));?>","Select Payment Method",objFormData);
				
			}
		});	
		var donor=$("#frmFormDonation").find("#donor_id");
		var donor2=$("#frmFormSponsorship").find("#donor_id");
		var donor_array=[donor,donor2];		
		populateOptionValuesDonorBulk(donor_array,"<?php echo $this->url('adminpanel/donor', array('action'=>'getdonor'));?>","Select Donor");
		
		var transaction_type=$("#frmFormDonation").find("#transaction_type_id");
		var transaction_type_array=[transaction_type];
		populateOptionValuesBulk(transaction_type_array,"<?php echo $this->url('adminpanel/transaction-type', array('action'=>'gettransactiontype'));?>","Select Transaction Type");
		var gl_account=$("#frmFormDonation").find("#gl_account_id");
		var gl_account_array=[gl_account];
		populateOptionValuesBulk(gl_account_array,"<?php echo $this->url('adminpanel/gl-account', array('action'=>'getglaccount'));?>","Select Gl Account");
/*********************************Donation Click populate End*******************************************/

/*********************************Sponsorship Click populate Start*******************************************/
		
		var currency1=$("#frmFormSponsorship").find("#currency");
		var currency_exchange_rate1=$("#frmFormSponsorship").find("#currency_exchange_rate_id");
		var currency_exchange_rate_array1=[currency_exchange_rate1];
		var currency_array1=[currency1];
		populateOptionValuesBulk(currency_array1,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		currency1.change(function()
		{
			var currency1 =$(this).val();
			
			if(currency1 > 0)
			{
				var objFormData = {
						from_currency    : currency1
				}
				
				populateDependentOptionValuesObjectBulk(currency_exchange_rate_array1,"<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
			}
		});
		var nationality_id=$("#frmFormDonor").find("#nationality_id");
		var nationality_id_array=[nationality_id];
		populateOptionValuesBulk(nationality_id_array,"<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Nationality");
		$("#date_of_birth1").datepicker();
		
/*********************************Sponsorship Click populate End*******************************************/
/*********************************Manage Groups Click populate Start*******************************************/
		
		
		var beneficiary_group=$("#frmFormManageGroups").find("#beneficiary_group_id");
		var beneficiary_group_array=[beneficiary_group];
		populateOptionValuesBulk(beneficiary_group_array,"<?php echo $this->url('adminpanel/group', array('action'=>'getgroup'));?>","Select Beneficiary Group");
		
/*********************************Manage Groups Click populate End*******************************************/

/*********************************Manage Asset Click populate Start*******************************************/
		
		
		
		
		$("#frmFormManageAsset").find("#beneficiary_profile_asset_received_date").datepicker();
/*********************************Manage Asset Click populate End*******************************************/
/*********************************Change Organization Click populate Start*******************************************/
		var target_organization=$("#frmFormChangeOrganization").find("#target_organization_id");
		var target_organization_array=[target_organization];		
		populateOptionValuesBulk(target_organization_array,"<?php echo $this->url('adminpanel/organization', array('action'=>'getorganization'));?>","Select Target Organization");
		
/*********************************Change Organization Click populate End*******************************************/
		hideShowLoaderActive(false);	
	});

</script>
