<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">

	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
			
			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="<?php echo $this->basePath(); ?>/public/admin/img/avatars/sunny.png" alt="me" class="online" /> 
				<span>
					john.doe 
				</span>
				<i class="fa fa-angle-down"></i>
			</a> 
			
		</span>
	</div>
	<!-- end user info -->

	<!-- NAVIGATION : This navigation is also responsive

	To make this navigation dynamic please make sure to link the node
	(the reference to the nav > ul) after page load. Or the navigation
	will not initialize.
	-->
	<nav>
		<!-- 
		NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional href="" links. See documentation for details.
		-->

		<ul>
			<li class="">
				<a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboards</span></a>
				<ul>
					<li class="">
						<a href="global-dashboard" title="Global Dashboard"><i class="fa fa-lg fa-fw fa-globe"></i> <span class="menu-item-parent">Global</span></a>
					</li>
					<li class="">
						<a href="beneficiaries-dashboard" title="Beneficiaries Dashboard"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Beneficiaries</span></a>
					</li>
					<li class="">
						<a href="projects-dashboard" title="Projects Dashboard"><i class="fa fa-lg fa-fw fa-folder"></i> <span class="menu-item-parent">Projects</span></a>
					</li>
					<li class="">
						<a href="payments-dashboard" title="Payments Dashboard"><i class="fa fa-lg fa-fw fa-money"></i> <span class="menu-item-parent">Payments</span></a>
					</li>
					<li class="">
						<a href="assets-dashboard" title="Assets Dashboard"><i class="fa fa-lg fa-fw fa-codepen"></i> <span class="menu-item-parent">Assets</span></a>
					</li>
					<li class="">
						<a href="posts-dashboard" title="Posts Dashboard"><i class="fa fa-lg fa-fw fa-crosshairs"></i> <span class="menu-item-parent">Posts</span></a>
					</li>
				</ul>	
			</li>
			<li class="">
				<a href="#" title="Settings"><i class="fa fa-lg fa-fw fa-gears"></i> <span class="menu-item-parent">Settings</span></a>
				<ul>
					<li class="">
						<a href="#" title="General Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">General Settings</span></a>
						<ul>
							<li class="">
								<a href="configurations" title="Configurations"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Configurations</span></a>
							</li>
							<li class="">
								<a href="menu-categories" title="Menu Categories"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Menu Categories</span></a>
							</li>
							<li class="">
								<a href="menu" title="Menus"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Menus</span></a>
							</li>
							<li class="">
								<a href="marital-statuses" title="Marital Statuses"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Marital Statuses</span></a>
							</li>
							<li class="">
								<a href="education-levels" title="Education Levels"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Education Levels</span></a>
							</li>
							<li class="">
								<a href="medical-conditions" title="Medical Conditions"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Medical Conditions</span></a>
							</li>
							<li class="">
								<a href="death-reasons" title="Death Reasons"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Death Reasons</span></a>
							</li>
							<li class="">
								<a href="media-files-types" title="Media Files Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Media Files Types</span></a>
							</li>
							<li class="">
								<a href="media-statuses" title="Media Statuses"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Media Statuses</span></a>
							</li>
							<li class="">
								<a href="media-categories" title="Media Categories"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Media Categories</span></a>
							</li>
							<li class="">
								<a href="media-types" title="Media Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Media Types</span></a>
							</li>
							<li class="">
								<a href="message-types" title="Message Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Message Types</span></a>
							</li>
							<li class="">
								<a href="message-templates" title="Message Templates"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Message Templates</span></a>
							</li>
							<li class="">
								<a href="asset" title="Assets"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Assets</span></a>
							</li>
							<li class="">
								<a href="asset-type" title="Asset Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Asset Types</span></a>
							</li>
							<li class="">
								<a href="asset-storage-types" title="Asset Storage Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Asset Storage Types</span></a>
							</li>
							<li class="">
								<a href="asset-unit-types" title="Asset Unit Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Asset Unit Types</span></a>
							</li>
							<li class="">
								<a href="asset-conditions" title="Asset Conditions"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Asset Conditions</span></a>
							</li>
							<li class="">
								<a href="countries" title="Countries"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Countries</span></a>
							</li>
							<li class="">
								<a href="cities" title="Cities"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Cities</span></a>
							</li>
							<li class="">
								<a href="locales" title="Locales"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Locales</span></a>
							</li>
							<li class="">
								<a href="translation" title="Translation"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Translation</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Beneficiary Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Beneficiary Settings</span></a>
						<ul>
							<li class="">
								<a href="beneficiary-profile" title="Beneficiary Profile"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Beneficiary Profile</span></a>
							</li>
							<li class="">
								<a href="volunteer-types" title="Volunteer Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Volunteer Types</span></a>
							</li>
							
							<li class="">
								<a href="disabled-types" title="Disabled Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Disabled Types</span></a>
							</li>
							<li class="">
								<a href="disabled-reasons" title="Disabled Reasons"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Disabled Reasons</span></a>
							</li>
							<li class="">
								<a href="family-flags" title="Family Flags"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Family Flags</span></a>
							</li>
							<li class="">
								<a href="family-professions" title="Family Professions"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Family Professions</span></a>
							</li>
							<li class="">
								<a href="income-types" title="Income Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Income Types</span></a>
							</li>
							<li class="">
								<a href="spending-types" title="Spending Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Spending Types</span></a>
							</li>
							<li class="">
								<a href="home-construction-types" title="Home Construction Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Home Construction Types</span></a>
							</li>
							<li class="">
								<a href="home-contract-types" title="Home Contract Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Home Contract Types</span></a>
							</li>
							<li class="">
								<a href="beneficiary-relations" title="Beneficiary Relations"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Beneficiary Relations</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Organization Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Organization Settings</span></a>
						<ul>
							<li class="">
								<a href="organization-flags" title="Organization Flags"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Organization Flags</span></a>
							</li>
							<li class="">
								<a href="organization-types" title="Organization Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Organization Types</span></a>
							</li>
							<li class="">
								<a href="organization-branches" title="Organization Branches"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Organization Branches</span></a>
							</li>
							<li class="">
								<a href="branch-committee" title="Branch Committees"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Branch Committees</span></a>
							</li>
							<li class="">
								<a href="branch-committee-user" title="Committee Users"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Committee Users</span></a>
							</li>
							<li class="">
								<a href="organization-user-position" title="Organization User Position"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> User Position</span></a>
							</li>
							<li class="">
								<a href="organization-asset" title="Assets"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Assets</span></a>
							</li>
							<li class="">
								<a href="assets-locations" title="Assets Locations"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Assets Locations</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Post Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Post Settings</span></a>
						<ul>
							<li class="">
								<a href="post-categories" title="Categories"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Categories</span></a>
							</li>
							<li class="">
								<a href="post-types" title="Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Types</span></a>
							</li>
							<li class="">
								<a href="post-author" title="Authors"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Authors</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Projects Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Projects Settings</span></a>
						<ul>
							<li class="">
								<a href="project-categories" title="Categories"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Categories</span></a>
							</li>
							<li class="">
								<a href="project-types" title="Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Types</span></a>
							</li>
							<li class="">
								<a href="project-masjed-type" title="Masjed Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Masjed Types</span></a>
							</li>
							<li class="">
								<a href="project-masjed-type-details" title="Masjed Type Details"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Masjed Type Details</span></a>
							</li>
							<li class="">
								<a href="project-masjed-construction-type" title="Masjed Construction Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Masjed Construction Types</span></a>
							</li>
							<li class="">
								<a href="project-masjed-furniture-type" title="Masjed Furniture Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Masjed Furniture Types</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Payments Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Payments Settings</span></a>
						<ul>
							<li class="">
								<a href="payment-method" title="Methods"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Methods</span></a>
							</li>
							<li class="">
								<a href="payment-method-configuration" title="Method Configurations"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Method Configurations</span></a>
							</li>
							<li class="">
								<a href="payment-processing-fees" title="Processing Fees"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Processing Fees</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Currency Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Currency Settings</span></a>
						<ul>
							<li class="">
								<a href="currencies" title="Currencies"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Currencies</span></a>
							</li>
							<li class="">
								<a href="currency-exchange-rate" title="Exchange Rate"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Exchange Rate</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Accounting Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Accounting Settings</span></a>
						<ul>
							<li class="">
								<a href="gl-account-type" title="Account Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Account Types</span></a>
							</li>
							<li class="">
								<a href="gl-account" title="Accounts"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Accounts</span></a>
							</li>
							<li class="">
								<a href="transaction-type" title="Transaction Types"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Transaction Types</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" title="Authorization Settings"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Authorization Settings</span></a>
						<ul>
							<li class="">
								<a href="admin-authorization-role" title="Roles"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Roles</span></a>
							</li>
							<li class="">
								<a href="authorization-resource" title="Resources"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Resources</span></a>
							</li>
							<li class="">
								<a href="admin-authorization-rule" title="Rules"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Rules</span></a>
							</li>
							<li class="">
								<a href="#" title="Authorization"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Authorization</span></a>
							</li>
							<li class="">
								<a href="authorization-organization-relation-role" title="Organization Relation Roles"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Organization Relation Roles</span></a>
							</li>
							<li class="">
								<a href="#" title="Organization User Relations"><span class="menu-item-parent"> <i class="fa fa-fw fa-folder-open"></i> Organization User Relations</span></a>
							</li>
						</ul>
					</li>
				</ul>	
			</li>
			<li class="">
				<a href="#" title="Beneficiaries"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Beneficiaries</span></a>
				<ul>
					<li class="">
						<a href="beneficiary" title="Manage"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Manage</span></a>
					</li>
					<li class="">
						<a href="advance-search-form" title="Advance search form"><i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent">Advance search form</span></a>
					</li>
					<li class="">
						<a href="gallery" title="Gallery"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Gallery</span></a>
					</li>
					<li class="">
						<a href="donation" title="Donations"><i class="fa fa-lg fa-fw fa-dollar"></i> <span class="menu-item-parent">Donations</span></a>
					</li>
					<li class="">
						<a href="research-notes" title="Research Notes"><i class="fa fa-lg fa-fw fa-outdent"></i> <span class="menu-item-parent">Research Notes</span></a>
					</li>
					<li class="">
						<a href="beneficiary-profile-asset-received" title="Assets received"><i class="fa fa-lg fa-fw fa-mail-reply-all"></i> <span class="menu-item-parent">Assets received</span></a>
					</li>
					<li class="">
						<a href="beneficiary-profile-asset-required" title="Assets required"><i class="fa fa-lg fa-fw fa-thumbs-up"></i> <span class="menu-item-parent">Assets required</span></a>
					</li>
					<li class="">
						<a href="group" title="Groups"><i class="fa fa-lg fa-fw fa-tasks"></i> <span class="menu-item-parent">Groups</span></a>
					</li>
					<li class="">
						<a href="message" title="Messages"><i class="fa fa-lg fa-fw fa-envelope"></i> <span class="menu-item-parent">Messages</span></a>
					</li>
				</ul>	
			</li>
			<?php /*?>
			<li class="">
				<a href="#" title="Frontend Components"><i class="fa fa-lg fa-fw fa-desktop"></i> <span class="menu-item-parent">Frontend Components</span></a>
				<ul>
					<li class="">
						<a href="#" title="Top Menu"><span class="menu-item-parent">Top Menu</span></a>
					</li>
					<li class="">
						<a href="#" title="Main Menu"><span class="menu-item-parent">Main Menu</span></a>
					</li>
					<li class="">
						<a href="#" title="Footer Menu"><span class="menu-item-parent">Footer Menu</span></a>
					</li>
					<li class="">
						<a href="#" title="Login / Registration [Beneficiary | Organization | Donator]"><span class="menu-item-parent">Login / Registration</span></a>
					</li>
					<li class="">
						<a href="#" title="Donate Now Box"><span class="menu-item-parent">Donate Now Box</span></a>
					</li>
					<li class="">
						<a href="#" title="Announcements / Latest News"><span class="menu-item-parent">Announcements / Latest News</span></a>
					</li>
					<li class="">
						<a href="#" title="Trending Tangibles"><span class="menu-item-parent">Trending Tangibles</span></a>
					</li>
					<li class="">
						<a href="#" title="Search"><span class="menu-item-parent">Search</span></a>
					</li>
					<li class="">
						<a href="#" title="Our Partners"><span class="menu-item-parent">Our Partners</span></a>
					</li>
					<li class="">
						<a href="#" title="Featured Organizations"><span class="menu-item-parent">Featured Organizations</span></a>
					</li>
					<li class="">
						<a href="#" title="Upcoming Events"><span class="menu-item-parent">Upcoming Events</span></a>
					</li>
					<li class="">
						<a href="#" title="Poll Box"><span class="menu-item-parent">Poll Box</span></a>
					</li>
				</ul>	
			</li>
			<li class="">
				<a href="#" title="Delivery Timeline"><i class="fa fa-lg fa-fw fa-ticket"></i> <span class="menu-item-parent">Delivery Timeline</span></a>
			</li>
			<li class="">
				<a href="#" title="Other Conditions"><i class="fa fa-lg fa-fw fa-recycle"></i> <span class="menu-item-parent">Other Conditions</span></a>
			</li>
			<li class="">
				<a href="#" title="Payments"><i class="fa fa-lg fa-fw fa-dollar"></i> <span class="menu-item-parent">Payments</span></a>
			</li>
			<?php */ ?>
		</ul>
	</nav>
	<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
<!-- END NAVIGATION -->