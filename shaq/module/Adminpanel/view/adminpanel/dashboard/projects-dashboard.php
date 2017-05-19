<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		DASHBOARD &nbsp; &raquo; &nbsp; PROJECTS DASHBOARD
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
	<!-- Bread crumb is created dynamically -->	
	<!-- row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total<br />Projects</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>	
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total<br />Active Projects</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>		
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total<br />Completed</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total Inactive Projects</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>	
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total Published Projects</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>	
			<div class="col-sm-2">
				<div class="panel panel-danger ">
					<div class="panel-heading text-center font-md txt-Dark">Total Unpublished Projects</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-redLight">50</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">	
			<div class="col-sm-12 well">
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-recieved-assets-breakdown" data-graph-type="line">
				  <caption>Status Breakdown</caption>
				  <thead>
					<tr>
					   <th>Project Status</th>
					   <th data-graph-color="#F79DD2">Total number of projects</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>Draft</td>
					  <td class="">10</td>
					</tr>
					<tr>
					  <td>Active</td>
					  <td class="">0</td>
					</tr>
					<tr>
					  <td>Completed</td>
					  <td class="">8</td>
					</tr>
					<tr>
					  <td>Canceled</td>
					  <td class="">1</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-recieved-assets-breakdown"></div>				
			</div>
			<div class="col-sm-12 well"> 
				<table class="highchart hide"  data-graph-container=".highchart-number-of-collection-breakdown" data-graph-type="pie" data-graph-datalabels-enabled="1">
				<caption>Category & Type Breakdown</caption>
					<thead>
						<tr>                                  
							<th>Total active projects per project category per project type</th>
							<th>Total number of projects</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Category 1</td>
							<td data-graph-item-color="#F79DD2" data-graph-name="Category 1" >20</td>
						</tr>
						<tr>
							<td>Category 2</td>
							<td data-graph-item-color="#FF80A6" data-graph-name="Category 2">10</td>
						</tr>
						<tr>
							<td>Category 2</td>
							<td data-graph-item-color="#B981BC" data-graph-name="Category 2">10</td>
						</tr>
						<tr>
							<td>Category 2</td>
							<td data-graph-item-color="#A08AAC" data-graph-name="Category 2">10</td>
						</tr>
					</tbody>
				</table>
				<div class="highchart-number-of-collection-breakdown"></div>
			</div>
			
			
		</div>	
		<div class="col-sm-6">
			<div class="col-sm-12 well">
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-active-project-below-target" data-graph-type="area">
				  <caption>Active projects below target</caption>
				  <thead>
					<tr>
					   <th>Project Name</th>
					   <th data-graph-color="#FF80A6">Target Amount</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>Project 1</td>
					  <td class="">1000</td>
					</tr>
					<tr>
					  <td>Project 2</td>
					  <td class="">2500</td>
					</tr>
					<tr>
					  <td>Project 3</td>
					  <td class="">1750</td>
					</tr>
					<tr>
					  <td>Project 4</td>
					  <td class="">2180</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-active-project-below-target"></div>				
			</div>
			<div class="col-sm-12 well">
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-active-project-over-target" data-graph-type="spline">
				  <caption>Active projects over target</caption>
				  <thead>
					<tr>
					   <th>Project Name</th>
					   <th data-graph-color="#B981BC">Target Amount</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>Project 5</td>
					  <td class="">5000</td>
					</tr>
					<tr>
					  <td>Project 6</td>
					  <td class="">15000</td>
					</tr>
					<tr>
					  <td>Project 7</td>
					  <td class="">1000</td>
					</tr>
					<tr>
					  <td>Project 8</td>
					  <td class="">25000</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-active-project-over-target"></div>				
			</div>			
		</div>	
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">

		<!-- new widget -->
		<div class="jarviswidget jarviswidget-color-blueDark">

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
				<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
				<h2> My Events </h2>
				<div class="widget-toolbar">
					<!-- add: non-hidden - to disable auto hide -->
					<div class="btn-group">
						<button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
							Showing <i class="fa fa-caret-down"></i>
						</button>
						<ul class="dropdown-menu js-status-update pull-right">
							<li>
								<a href="javascript:void(0);" id="mt">Month</a>
							</li>
							<li>
								<a href="javascript:void(0);" id="ag">Agenda</a>
							</li>
							<li>
								<a href="javascript:void(0);" id="td">Today</a>
							</li>
						</ul>
					</div>
				</div>
			</header>

			<!-- widget div-->
			<div>

				<div class="widget-body no-padding">
					<!-- content goes here -->
					<div class="widget-body-toolbar">

						<div id="calendar-buttons">

							<div class="btn-group">
								<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
								<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
					<div id="calendar"></div>

					<!-- end content -->
				</div>

			</div>
			<!-- end widget div -->
		</div>
		<!-- end widget -->

	</div>
	</div>
	<!-- end row -->
</div>
<!-- END #MAIN CONTENT -->
<script type="text/javascript">
		pageSetUp();
		
		var pagefunction = function() {
			// clears the variable if left blank
			$('table.highchart').highchartTable();
			
			
		
		// full calendar
		
		var date = new Date();
	    var d = date.getDate();
	    var m = date.getMonth();
	    var y = date.getFullYear();
	
	    var hdr = {
	        left: 'title',
	        center: 'month,agendaWeek,agendaDay',
	        right: 'prev,today,next'
	    };
	
	
	    /* initialize the calendar
		 -----------------------------------------------------------------*/
	
	    fullviewcalendar = $('#calendar').fullCalendar({
	
	        header: hdr,
			        editable: true,
			        droppable: true, // this allows things to be dropped onto the calendar !!!
			
			        drop: function (date, allDay) { // this function is called when something is dropped
			
			            // retrieve the dropped element's stored Event Object
			            var originalEventObject = $(this).data('eventObject');
			
			            // we need to copy it, so that multiple events don't have a reference to the same object
			            var copiedEventObject = $.extend({}, originalEventObject);
			
			            // assign it the date that was reported
			            copiedEventObject.start = date;
			            copiedEventObject.allDay = allDay;
			
			            // render the event on the calendar
			            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			            // is the "remove after drop" checkbox checked?
			            if ($('#drop-remove').is(':checked')) {
			                // if so, remove the element from the "Draggable Events" list
			                $(this).remove();
			            }
			
			        },
			
			        select: function (start, end, allDay) {
			            var title = prompt('Event Title:');
			            if (title) {
			                calendar.fullCalendar('renderEvent', {
			                        title: title,
			                        start: start,
			                        end: end,
			                        allDay: allDay
			                    }, true // make the event "stick"
			                );
			            }
			            calendar.fullCalendar('unselect');
			        },
			
			        events: [{
			            title: 'All Day Event',
			            start: new Date(y, m, 1),
			            description: 'long description',
			            className: ["event", "bg-color-greenLight"],
			            icon: 'fa-check'
			        }, {
			            title: 'Long Event',
			            start: new Date(y, m, d - 5),
			            end: new Date(y, m, d - 2),
			            className: ["event", "bg-color-red"],
			            icon: 'fa-lock'
			        }, {
			            id: 999,
			            title: 'Repeating Event',
			            start: new Date(y, m, d - 3, 16, 0),
			            allDay: false,
			            className: ["event", "bg-color-blue"],
			            icon: 'fa-clock-o'
			        }, {
			            id: 999,
			            title: 'Repeating Event',
			            start: new Date(y, m, d + 4, 16, 0),
			            allDay: false,
			            className: ["event", "bg-color-blue"],
			            icon: 'fa-clock-o'
			        }, {
			            title: 'Meeting',
			            start: new Date(y, m, d, 10, 30),
			            allDay: false,
			            className: ["event", "bg-color-darken"]
			        }, {
			            title: 'Lunch',
			            start: new Date(y, m, d, 12, 0),
			            end: new Date(y, m, d, 14, 0),
			            allDay: false,
			            className: ["event", "bg-color-darken"]
			        }, {
			            title: 'Birthday Party',
			            start: new Date(y, m, d + 1, 19, 0),
			            end: new Date(y, m, d + 1, 22, 30),
			            allDay: false,
			            className: ["event", "bg-color-darken"]
			        }, {
			            title: 'Smartadmin Open Day',
			            start: new Date(y, m, 28),
			            end: new Date(y, m, 29),
			            className: ["event", "bg-color-darken"]
			        }],
			
			        eventRender: function (event, element, icon) {
			            if (!event.description == "") {
			                element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description +
			                    "</span>");
			            }
			            if (!event.icon == "") {
			                element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon +
			                    " '></i>");
			            }
			        },
			
			        windowResize: function (event, ui) {
			            $('#calendar').fullCalendar('render');
			        }
			    });
		
		    /* hide default buttons */
		    $('.fc-right, .fc-center').hide();

		
			$('#calendar-buttons #btn-prev').click(function () {
			    $('.fc-prev-button').click();
			    return false;
			});
			
			$('#calendar-buttons #btn-next').click(function () {
			    $('.fc-next-button').click();
			    return false;
			});
			
			$('#calendar-buttons #btn-today').click(function () {
			    $('.fc-today-button').click();
			    return false;
			});
			
			$('#mt').click(function () {
			    $('#calendar').fullCalendar('changeView', 'month');
			});
			
			$('#ag').click(function () {
			    $('#calendar').fullCalendar('changeView', 'agendaWeek');
			});
			
			$('#td').click(function () {
			    $('#calendar').fullCalendar('changeView', 'agendaDay');
			});	
					
		
	
	
		};
		
		var pagedestroy = function(){
			// destroy vector map objects
			fullviewcalendar.fullCalendar( 'destroy' );
			fullviewcalendar = null;
			$("#add-event").off();
			$("#add-event").remove();
	
			$('#external-events > li').off();
			$('#external-events > li').remove();
			$('#add-event').off();
			$('#add-event').remove();
			$('#calendar-buttons #btn-prev').off();
			$('#calendar-buttons #btn-prev').remove();
			$('#calendar-buttons #btn-next').off();
			$('#calendar-buttons #btn-next').remove();
			$('#calendar-buttons #btn-today').off();
			$('#calendar-buttons #btn-today').remove();
			$('#mt').off();
			$('#mt').remove();
			$('#ag').off();
			$('#ag').remove();
			$('#td').off();
			$('#td').remove();
		}
			
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highChartCore/highcharts-custom.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highchartTable/jquery.highchartTable.min.js", function(){
				loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/moment/moment.min.js", function(){
					loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js", pagefunction);
				});

			}); 
		});		
		
		
</script>