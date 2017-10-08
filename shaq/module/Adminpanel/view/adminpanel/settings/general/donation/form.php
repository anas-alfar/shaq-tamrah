<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Donation Info </h2>
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
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false"  data-widget-fullscreenbutton="false" data-widget-togglebutton="false">	
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
																		<label class="control-label">Beneficiary<span>*</span></label>
																			<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
																				<option value="0">Select Beneficiary</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset<span>*</span></label>
																			<select class="select2" id="asset_id" name="asset_id" type="select">														
																				<option value="0">Select Asset</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Type<span>*</span></label>
																			<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
																				<option value="0">Select Asset Type</option>
																			</select> 
																	</div>
																</section>		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Unit<span>*</span></label>
																			<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
																				<option value="0">Select Asset Unit</option>
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
																		<label class="control-label">Asset Value<span>*</span></label>
																		<input type="text" class="form-control" name="asset_value" id="asset_value"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Receipt Number<span>*</span></label>
																		<input type="text" class="form-control" name="receipt_number" id="receipt_number"/>
																	</div>
																 </section>
															</div>
															<div class="row">
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
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">	
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
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">	
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
</section>	
								
