var ckanURL = Drupal.settings.landbook.ckanURL;

jQuery( document ).ajaxStart(function() {
       showLoading();
});
jQuery( document ).ajaxComplete(function() {
       hideLoading();
});

firstLoad();

jQuery("#srch-term-ckan").keypress(function(event) {
	if(event.which == 13) {
		loadSearchResults();
		jQuery(this).val("");
	}
});

function showLoading() {
    //$("#loading-dialog").modal();
}
        
function hideLoading() {
    //$("#loading-dialog").modal('hide');
}

function firstLoad() {
	getFullPackages(100,0, function(output) {
		var packages = output;
		if(packages.success) {
			formatContent(packages.result, true);
		} else {
		jQuery(".result-content").html("<div class='row'><div class='col-sm-9 dataset-message'>No datasets found</div></div>");
		}
	});
}

function loadSearchResults() {
	var keywords = jQuery("#srch-term-ckan").val();
	searchPackages(keywords, function(output) {
		var packages = output;
		if(packages.success) {
			formatContent(packages.result.results, true);
		} else {
		jQuery(".result-content").html("<div class='row'><div class='col-sm-9 dataset-message'>No datasets found</div></div>");
	}
	}); 
}

function formatContent(packages, fullMode) {
	jQuery("#panel-datasets").empty();		
	organizations = {};
	organizations_ids = {};
	groups = {};
	groups_ids = {};
	tags = {};
	tags_ids = {};
	formats = {};
	licenses = {};
	
	if(fullMode) {
		datasets = packages;
	} else {
		datasets = packages.packages;
	}
	
	jQuery.each(datasets, function(index, dataset) {
		jQuery("#panel-datasets").append(formatDatasetResult(dataset, index));
		if(fullMode) {
			extractDatasetOrganizations(dataset, organizations, organizations_ids);
			extractDatasetGroups(dataset, groups, groups_ids);
			extractDatasetTags(dataset, tags, tags_ids);
			extractDatasetFormats(dataset, formats);
			extractDatasetLicenses(dataset, licenses);
		} else {
			if(typeof packages.is_organization == 'undefined') {
				extractDatasetOrganizations(packages, organizations, organizations_ids);
			} if(typeof packages.is_group == 'undefined') {
				extractDatasetGroups(packages, groups, groups_ids);
			} if (typeof packages.is_tag == 'undefined') {
				extractDatasetTags(packages, tags, tags_ids);
			}
			extractDatasetFormats(dataset, formats);
			extractDatasetLicenses(dataset, licenses);
		}
	});
	
	if(typeof packages.is_organization == 'undefined') {
		formatOrganizations(organizations, organizations_ids);
	} if(typeof packages.is_group == 'undefined') {
		formatGroups(groups, groups_ids);
	} if (typeof packages.is_tag == 'undefined') {
		formatTags(tags, tags_ids);
	}
	formatFormats(formats);
	formatLicenses(licenses);
	
	wesCountry.table.pages.apply();
}

function extractDatasetOrganizations(dataset, organizations, organizations_ids) {
	if (typeof dataset.organization != 'undefined') {
		organization = dataset.organization.title;
		
		if(organizations[organization] != undefined) {
			organizations[organization]++;
		} else {
			organizations[organization] = 1;
			organizations_ids[organization] = dataset.organization.name;
		}
	}
}

function extractDatasetGroups(dataset, groups, groups_ids) {
	if (typeof dataset.groups != 'undefined') {
		jQuery.each(dataset.groups, function(index, group) {
			groupTitle = group.title;
			
			if(groups[groupTitle] != undefined) {
				groups[groupTitle]++;
			} else {
				groups[groupTitle] = 1;
				groups_ids[groupTitle] = group.name;
			}
		});
	}
}

function extractDatasetTags(dataset, tags, tags_ids) {
	if (typeof dataset.tags != 'undefined') {
		jQuery.each(dataset.tags, function(index, tag) {
			tagTitle = tag.display_name;
			
			if(tags[tagTitle] != undefined) {
				tags[tagTitle]++;
			} else {
				tags[tagTitle] = 1;
				tags_ids[tagTitle] = tag.name;
			}
		});
	}
}

function extractDatasetFormats(dataset, formats) {
	if(typeof dataset.resources != 'undefined') {
		jQuery.each(dataset.resources, function(index, resource) {
			format = resource.format;
			
			if (format != "") {
				if(formats[format] != undefined) {
					formats[format]++;
				} else {
					formats[format] = 1;
				}
			}
		});
	}
}

function extractDatasetLicenses(dataset, licenses) {
	if (dataset.license_title != undefined) {
		license = dataset.license_title;

		if(licenses[license] != undefined) {
			licenses[license]++;
		} else {
			licenses[license] = 1;
		}
	}
}

function formatOrganizations(organizations, organizations_ids) {
	if (!jQuery.isEmptyObject(organizations)) {
		jQuery("#panel-organizations .panel-footer").remove();

		organizationsPanel = jQuery("#panel-organizations .list-group");
		organizationsPanel.empty();
		counter=0;
		
		jQuery.each(organizations, function(organizationName, appearances) {
			organizationLink = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "organization/" + organizations_ids[organizationName]});
			organizationRow = jQuery("<li>", {class: "list-group-item"});
			organizationLink.html(organizationName + " (" + appearances + ")");
			organizationRow.append(organizationLink);
			organizationsPanel.append(organizationRow);
			counter++;
		});	
		
		if(counter > 5) {
			jQuery("#panel-organizations").append(createFilterPanelFooter());
		}
	}
}

function formatGroups(groups, groups_ids) {
	if(!jQuery.isEmptyObject(groups)) {
		jQuery("#panel-groups .panel-footer").remove();

		groupsPanel = jQuery("#panel-groups .list-group");
		groupsPanel.empty();
		
		counter = 0;
		jQuery.each(groups, function(groupName, appearances) {
			groupLink = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "group/" + groups_ids[groupName]});
			groupRow = jQuery("<li>", {class: "list-group-item"});
			groupLink.html(groupName + " (" + appearances + ")");
			groupRow.append(groupLink);
			groupsPanel.append(groupRow);
			counter++;
		});	
		
		if(counter > 5) {
			jQuery("#panel-groups").append(createFilterPanelFooter());
		}
	}
}

function formatTags(tags, tags_ids) {
	if(!jQuery.isEmptyObject(tags)) {
		jQuery("#panel-tags .panel-footer").remove();

		tagsPanel = jQuery("#panel-tags .list-group");
		tagsPanel.empty();
		counter = 0;
		jQuery.each(tags, function(tagName, appearances) {
			tagLink = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "tag/" + tags_ids[tagName]});
			tagRow = jQuery("<li>", {class: "list-group-item"});
			tagLink.html(tagName + " (" + appearances + ")");
			tagRow.append(tagLink);
			tagsPanel.append(tagRow);
			counter++;
		});
		
		if(counter > 5) {
			jQuery("#panel-tags").append(createFilterPanelFooter());
		}
	}
}

function formatFormats(formats) {
	if(!jQuery.isEmptyObject(formats)) {
		jQuery("#panel-formats .panel-footer").remove();

		formatsPanel = jQuery("#panel-formats .list-group");
		formatsPanel.empty();
		counter = 0;
		jQuery.each(formats, function(formatName, appearances) {
			formatLink = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "dataset?res_format=" + formatName})
			formatRow = jQuery("<li>", {class: "list-group-item"});
			formatLink.html(formatName + " (" + appearances + ")");
			formatRow.append(formatLink);
			formatsPanel.append(formatRow);
			counter++;
		});	
		
		if(counter > 5) {
			jQuery("#panel-formats").append(createFilterPanelFooter());
		}
	}
}

function formatLicenses(licenses) {
	if(!jQuery.isEmptyObject(licenses)) {
		jQuery("#panel-licenses .panel-footer").remove();
		licensesPanel = jQuery("#panel-licenses .list-group");
		licensesPanel.empty();
		counter = 0;
		jQuery.each(licenses, function(licenseName, appearances) {
			licenseLink = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "dataset?license_title=" + licenseName})
			licenseRow = jQuery("<li>", {class: "list-group-item"});
			licenseLink.html(licenseName + " (" + appearances + ")");
			licenseRow.append(licenseLink);
			licensesPanel.append(licenseRow);
			counter++;
		});	
		
		if(counter > 5) {
			jQuery("#panel-licenses").append(createFilterPanelFooter());
		}
	}
}

function createFilterPanelFooter() {
	panelFooter = jQuery("<div>", {class: "panel-footer  clickable", onclick: "expandPanel(this)"});
	panelFooter.html("Show more");
	return panelFooter;
}

function expandPanel(panel) {
	jQuery(panel).parent().toggleClass("ckan-filter-panel");
	if (jQuery(panel).parent().hasClass("ckan-filter-panel")) {
		jQuery(panel).html("Show more");
	} else {
		jQuery(panel).html("Show less");	
	}
	
}

function showElement(elementId) {
	jQuery("#" + elementId).removeClass("hidden");
}

function hideElement(elementId) {
	jQuery("#" + elementId).addClass("hidden");
}

function formatDatasetResult(dataset, index){
	$packagePanel = jQuery("<li>", {class: "list-group-item", 
							   onmouseover: "showElement( 'package" + index+"');",
							   onmouseout: "hideElement( 'package" + index+"');"});
	$packageTitle = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "dataset/" + dataset.name});
	$packageTitle.html(dataset.title);
	$packagePanel.hover(function() {
						jQuery("#" + elementId).toggleClass("hidden");
						alert("Hey!");
						},
						function() {
						jQuery("#" + elementId).toggleClass("hidden");
						});
	
	$packageResourcesNumber = jQuery("<span>", {class: "package-resources"});
	$packageResourcesNumber.html("(" + dataset.num_resources + ")");
	$packagePanel.append($packageTitle);
	$packagePanel.append($packageResourcesNumber);
	
	$collapsableDiv = jQuery("<div>", {id: "package" + index, class: "hidden"});
	
	$packagePanelBody = jQuery("<div>", {class: "panel-body"});
	$packageDescription = jQuery("<p>", {class: "package-description"});
	$packageDescription.html(dataset.notes);
	
	$packageFormats = jQuery("<div>", {class: "package-formats"});
	
	$packagePanelBody.append($packageDescription);
	
	if(typeof dataset.resources != 'undefined') {
		jQuery.each(dataset.resources, function(index, resource) {
			$resourceDiv = jQuery("<div>", {class: "package-resource"});
			$resourceLink = jQuery("<a>", {href: resource.url});
			$resourceLink.html(resource.name);
			
			$formatLabelLink = jQuery("<a>", {href: resource.url});
			$formatLabel = jQuery("<span>", {class: "label label-primary ckan-resource-url"});
			$formatLabel.html(resource.format);
			$formatLabelLink.append($formatLabel);
			$resourceDiv.append($formatLabelLink);
			$resourceDiv.append($resourceLink);
			$packageFormats.append($resourceDiv);
		});
		$packagePanelBody.append($packageFormats);
	}
	
	$collapsableDiv.append($packagePanelBody);
	$packagePanel.append($collapsableDiv);
	
	return $packagePanel;
}

/* Collapsabe code, replaced by simple lists */
/*
function formatDatasetResult(dataset, index){
	$packagePanel = jQuery("<div>", {class: "panel panel-default"});
	
	$packageHeading = jQuery("<div>", {class: "panel-heading"});
	$packagePanelTitle = jQuery("<h4>", {class : "panel-title"});
	$packageTitle = jQuery("<a>", {href: Drupal.settings.landbook.ckanURL + "dataset/" + dataset.name});
	$packageTitle.attr("data-toggle", "collapse");
	$packageTitle.attr("data-parent", "#accordion"); 
	$packageTitle.html(dataset.title);
	$packageResourcesNumber = jQuery("<span>", {class: "package-resources"});
	$packageResourcesNumber.html("(" + dataset.num_resources + ")");
	$packagePanelTitle.append($packageTitle);
	$packagePanelTitle.append($packageResourcesNumber);
	$packageHeading.append($packagePanelTitle);
	$packagePanel.append($packageHeading);
	
	if (index == 0) {
		$collapsableDiv = jQuery("<div>", {id: "package" + index, class: "panel-collapse collapse in"});
	} else {
		$collapsableDiv = jQuery("<div>", {id: "package" + index, class: "panel-collapse collapse"});
	}
	$packagePanelBody = jQuery("<div>", {class: "panel-body"});
	$packageDescription = jQuery("<p>", {class: "package-description"});
	$packageDescription.html(dataset.notes);
	
	$packageFormats = jQuery("<div>", {class: "package-formats"});
	
	$packagePanelBody.append($packageDescription);
	if(typeof dataset.resources != 'undefined') {
		jQuery.each(dataset.resources, function(index, resource) {
			$resourceDiv = jQuery("<div>", {class: "package-resource"});
			$resourceLink = jQuery("<a>", {href: resource.url});
			$resourceLink.html(resource.name);
			
			$formatLabelLink = jQuery("<a>", {href: resource.url});
			$formatLabel = jQuery("<span>", {class: "label label-primary ckan-resource-url"});
			$formatLabel.html(resource.format);
			$formatLabelLink.append($formatLabel);
			$resourceDiv.append($formatLabelLink);
			$resourceDiv.append($resourceLink);
			$packageFormats.append($resourceDiv);
		});
		$packagePanelBody.append($packageFormats);
	}
	$collapsableDiv.append($packagePanelBody);
	$packagePanel.append($collapsableDiv);
	
	return $packagePanel;
}*/

function getFullPackages(limit, offset, callback) {
	if(typeof(limit)==='undefined') limit = false;
	if(typeof(offset)==='undefined') offset = false;

	var arguments = [limit, offset];
	doAjaxQuery('get_full_packages', arguments, callback);
}

function getPackages(limit, offset) {
	if(typeof(limit)==='undefined') limit = false;
	if(typeof(offset)==='undefined') offset = false;

	var arguments = [limit, offset];
	var json = doAjaxQuery('get_packages', arguments);
}

function getPackage(packageId) {
	var arguments = [packageId];
	var json = doAjaxQuery('get_package', arguments);
}

function getGroups(orderBy, sort, groups, all_fields) {
	if(typeof(orderBy)==='undefined') orderBy = false;
	if(typeof(sort)==='undefined') sort = false;
	if(typeof(groups)==='undefined') groups = false;
	if(typeof(all_fields)==='undefined') all_fields = false;

	var arguments = [orderBy, sort, groups, all_fields];
	var json = doAjaxQuery('get_groups', arguments);
}

function getGroup(groupId) {
	var arguments = [groupId];
	var json = doAjaxQuery('get_group', arguments);
}

function getGroupPackages(groupId) {
	var arguments = [groupId];
	doAjaxQuery('get_group_packages', arguments, function(output) {
		var packages = output;
		emptyFilterPanels();
		if(packages.success) {
			groupsPanel = jQuery("#panel-groups .list-group");
			groupsPanel.empty();
			groupRow = jQuery("<li>", {id: packages.id, class: "list-group-item active-filter clickable", onclick: "firstLoad()"});
			groupRow.html(packages.result.display_name + " (" + packages.result.package_count + ")");
			groupsPanel.append(groupRow);
			formatContent(packages.result, false);
		} else {
			jQuery(".result-content").html("<div class='row'><div class='col-sm-9 dataset-message'>No datasets found</div></div>");
		}
	});
}

function getOrganizationPackages(organizationId) {
	var arguments = [organizationId];
	doAjaxQuery('get_organization_packages', arguments, function(output) {
		var packages = output;
		emptyFilterPanels();
		if(packages.success) {
			organizationsPanel = jQuery("#panel-organizations .list-group");
			organizationsPanel.empty();
			organizationRow = jQuery("<li>", {id: packages.id, class: "list-group-item active-filter clickable", onclick: "firstLoad()"});
			organizationIcon = jQuery("<i>", {class: "glyphicon glyphicon-remove"});
			organizationRow.append(organizationIcon);
			organizationTitle = jQuery("<span>");
			organizationTitle.html(packages.result.display_name + " (" + packages.result.package_count + ")");
			organizationRow.append(organizationIcon);
			organizationRow.append(organizationTitle);
			
			organizationsPanel.append(organizationRow);
			formatContent(packages.result, false);
		} else {
			jQuery(".result-content").html("<div class='row'><div class='col-sm-9 dataset-message'>No datasets found</div></div>");
		}
	});
}

function getTags(query, vocabularyId, all_fields) {
	if(typeof(query)==='undefined') query = false;
	if(typeof(vocabularyId)==='undefined') vocabularyId = false;
	if(typeof(all_fields)==='undefined') all_fields = false;
	
	var arguments = [query, vocabularyId, all_fields];
	var json = doAjaxQuery('get_tags', arguments);
}

function getTag(tagId) {
	var arguments = [tagId];
	var json = doAjaxQuery('get_tag', arguments);
}

function getTagPackages(tagId) {
	var arguments = [tagId];
	doAjaxQuery('get_tag_packages', arguments, function(output) {
		var packages = output;
		emptyFilterPanels();
		if(packages.success) {
			console.log(JSON.stringify(packages));
			tagsPanel = jQuery("#panel-tags .list-group");
			tagsPanel.empty();
			tagRow = jQuery("<li>", {id: packages.id, class: "list-group-item active-filter clickable", onclick: "firstLoad()"});
			tagRow.html(packages.result.display_name + " (" + packages.result.packages.length + ")");
			tagsPanel.append(tagRow);
			formatContent(packages.result, false);
		} else {
			jQuery(".result-content").html("<div class='row'><div class='col-sm-9 dataset-message'>No datasets found</div></div>");
		}
	});
}

function getLicenses() {
	var json = doAjaxQuery('get_licenses', null)
}

function searchPackages(keywords, callback) {
	var arguments = [keywords];
	doAjaxQuery('search_packages', arguments, callback);
}

function emptyFilterPanels() {
		jQuery("#panel-organizations .list-group").empty();
		jQuery("#panel-groups .list-group").empty();
		jQuery("#panel-tags .list-group").empty();
		jQuery("#panel-formats .list-group").empty();
		jQuery("#panel-licenses .list-group").empty();
		jQuery("#panel-organizations .panel-footer").remove();
		jQuery("#panel-groups .panel-footer").remove();
		jQuery("#panel-tags .panel-footer").remove();
		jQuery("#panel-formats .panel-footer").remove();
		jQuery("#panel-licenses .panel-footer").remove();
}

/*
function doAjaxQuery(phpFunction, phpArguments, handleData) {
	jQuery.ajax({
	    type: "POST",
	    url: jQuery("#api-url").val() + '/ckan_ajax_interface.php',
	    data: {functionname: phpFunction, arguments: phpArguments},
	    success: function (obj, textstatus) {
				console.log(obj);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        	  console.log(textStatus, errorThrown);
			  console.log(jqXHR);
        }
	});	
}*/

function doAjaxQuery(phpFunction, phpArguments, handleData) {
	jQuery.ajax({
	    type: "POST",
	    url: Drupal.settings.landbook.ajaxURL + '/ckan_ajax_interface.php',
	    dataType: 'json',
	    data: {functionname: phpFunction, arguments: phpArguments},
	    success: function (obj, textstatus) {
						if( !('error' in obj) ) {
							handleData(obj);
						}
						else {
							console.log(obj.debug);
							console.log(obj.error);
						}
        },
        error: function(jqXHR, textStatus, errorThrown) {
        	  console.log(textStatus, errorThrown);
			  console.log(jqXHR);
        }
	});	
}