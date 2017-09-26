<section id="widGrid" class="">
	<!-- row -->
		<div class="row">
			<!-- a blank row to get started -->
			<div class="col-sm-12">
				<div class="jarviswidget listing" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" id="wid-id-0"data-widget-sortable="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-list-ul"></i> </span>
					<h2>Media File Types Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/media-files-types', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="media-filetypes">Export 
							</button>
							<button class="btn btnImport" id="btnImport">Import
							</button>
							
							<button class="btn btnBulksave" id="btnBulkSave">
								<i class="fa fa-floppy-o"></i> &nbsp;Bulk Save
							</button>
							<button class="btn btnNew addEventBtn" id="btnNew">
								<i class="fa fa-plus"></i> &nbsp;New
							</button>
						</div>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">
						<form name="bulkSaveForm" id="bulkSaveForm">
						<table id="tblMasterList" class="table table-striped table-bordered" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Name" />
									</th>
									<th class="hasinput">
											<select id="publishedfilter" name="publishedfilter"class="searchdrop">
												<option value="">All</option>														
												<option value="<!--Yes-->">Yes</option>
												<option value="<!--No-->">No</option>
										   </select>   
									</th>
								</tr>
					            <tr>
									<th>Id</th>
				                    <th data-class="expand">Name</th>
									<th data-hide="phone,tablet">Published</th>
									<th data-hide="phone" class="action">Action</th>
					            </tr>
					        </thead>							
					        <tbody></tbody>							
						</table>
						</form>	
					</div>
					<div class="row">
               <div class="col-md-3">
                  <div class="mb-lg">
                     <input type="file" data-input="false" data-buttonname="btn btn-info" data-buttontext="UPLOAD" data-iconname="fa fa-upload mr" class="form-control filestyle" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><span class="group-span-filestyle " tabindex="0"><label for="filestyle-0" class="btn btn btn-info "><span class="icon-span-filestyle fa fa-upload mr"></span> <span class="buttonText">UPLOAD</span></label></span></div>
                  </div>
                  <div class="panel b">
                     <div class="panel-body">
                        <strong class="text-muted">FOLDERS</strong>
                     </div>
                     <div class="list-group">
                        <a href="#" class="active list-group-item">
                           <span class="badge">49</span>
                           <span class="circle bg-white mr"></span>
                           <span>All</span>
                        </a>
                        <a href="#" class="list-group-item">
                           <span class="badge">5</span>
                           <span class="circle circle-green mr"></span>
                           <span>Audio</span>
                        </a>
                        <a href="#" class="list-group-item">
                           <span class="badge">12</span>
                           <span class="circle circle-danger mr"></span>
                           <span>Movie</span>
                        </a>
                        <a href="#" class="list-group-item">
                           <span class="badge">22</span>
                           <span class="circle circle-warning mr"></span>
                           <span>Image</span>
                        </a>
                        <a href="#" class="list-group-item">
                           <span class="badge">9</span>
                           <span class="circle circle-purple mr"></span>
                           <span>Code</span>
                        </a>
                     </div>
                     <div class="panel-body">
                        <div class="clearfix text-sm">
                           <p class="pull-left">Storage</p>
                           <p class="pull-right">
                              <strong>25 GB / 100 GB</strong>
                           </p>
                        </div>
                        <div class="progress progress-xs m0">
                           <div style="width:25%" class="progress-bar progress-bar-info">25%</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="row">
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">A good song.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">6.3MB</small>
                                 <small class="pull-left">10m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="movie" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-movie-o text-danger"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Movie.avi</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">6.3GB</small>
                                 <small class="pull-left">50m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Similar - Chosen.mp3</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">12MB</small>
                                 <small class="pull-left">20h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">El-Capitan.jpg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">300KB</small>
                                 <small class="pull-left">1d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="archive" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-archive-o text-warning"></em>
                              </a>
                              <p>
                                 <small class="text-dark">report-2016.txt</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">1MB</small>
                                 <small class="pull-left">15h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Song for you.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">4.5MB</small>
                                 <small class="pull-left">5m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="code" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-code-o text-purple"></em>
                              </a>
                              <p>
                                 <small class="text-dark">bypass.c</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">3KB</small>
                                 <small class="pull-left">2h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Sunset_red.png</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">450KB</small>
                                 <small class="pull-left">3d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Sunset_red.png</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">450KB</small>
                                 <small class="pull-left">3d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="code" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-code-o text-purple"></em>
                              </a>
                              <p>
                                 <small class="text-dark">angular.controller.js</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">5KB</small>
                                 <small class="pull-left">23h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Song 4 you.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">4.5MB</small>
                                 <small class="pull-left">5m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Similar - Chosen.mp3</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">12MB</small>
                                 <small class="pull-left">20h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Song 4 you.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">4.5MB</small>
                                 <small class="pull-left">5m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="code" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-code-o text-purple"></em>
                              </a>
                              <p>
                                 <small class="text-dark">ng.components.css</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">78KB</small>
                                 <small class="pull-left">12h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Sunset_red.png</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">450KB</small>
                                 <small class="pull-left">3d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="archive" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-archive-o text-warning"></em>
                              </a>
                              <p>
                                 <small class="text-dark">report-2016.txt</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">1MB</small>
                                 <small class="pull-left">15h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>

                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">A good song.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">6.3MB</small>
                                 <small class="pull-left">10m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="movie" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-movie-o text-danger"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Movie.avi</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">6.3GB</small>
                                 <small class="pull-left">50m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Similar - Chosen.mp3</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">12MB</small>
                                 <small class="pull-left">20h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">El-Capitan.jpg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">300KB</small>
                                 <small class="pull-left">1d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Song 4 you.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">4.5MB</small>
                                 <small class="pull-left">5m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="code" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-code-o text-purple"></em>
                              </a>
                              <p>
                                 <small class="text-dark">ng.components.css</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">78KB</small>
                                 <small class="pull-left">12h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Sunset_red.png</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">450KB</small>
                                 <small class="pull-left">3d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="archive" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-archive-o text-warning"></em>
                              </a>
                              <p>
                                 <small class="text-dark">report-2016.txt</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">1MB</small>
                                 <small class="pull-left">15h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="image" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-image-o text-success"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Sunset_red.png</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">450KB</small>
                                 <small class="pull-left">3d ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="code" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-code-o text-purple"></em>
                              </a>
                              <p>
                                 <small class="text-dark">angular.controller.js</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">5KB</small>
                                 <small class="pull-left">23h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Song 4 you.ogg</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">4.5MB</small>
                                 <small class="pull-left">5m ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div data-filter-group="audio" class="panel discoverer">
                           <div class="panel-body text-center">
                              <div class="clearfix discover">
                                 <div class="pull-right">
                                    <a href="#" title="Download" class="text-muted mr-sm">
                                       <em class="fa fa-download fa-fw"></em>
                                    </a>
                                 </div>
                              </div>
                              <a href="#" class="file-icon ph-lg">
                                 <em class="fa fa-5x fa-file-audio-o text-primary"></em>
                              </a>
                              <p>
                                 <small class="text-dark">Similar - Chosen.mp3</small>
                              </p>
                              <div class="clearfix m0 text-muted">
                                 <small class="pull-right">12MB</small>
                                 <small class="pull-left">20h ago</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
			</div>			
		</div>
	<!-- end row -->
	</section>