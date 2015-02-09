
<div class="content main-content container">
	<div class="row">
	  <div class="col-sm-9">
		  <div class="input-group search dataset-search">
			<input type="text" class="form-control" placeholder="<?php echo t("Search"); ?>" name="srch-term" id="srch-term-ckan">
				<div class="input-group-btn">
					<button class="btn" type="submit" onclick="loadSearchResults()"><i class="glyphicon glyphicon-search"></i></button>
				</div>
		  </div>
		  <div id="panel-datasets" class="panel panel-default">
				<?php echo t("Searching for datasets..."); ?>
		  </div>
      </div>
	  <div class="col-sm-3">
		  <div id="panel-organizations" class="panel panel-default ckan-filter-panel">
			  <div class="panel-heading">
			  	<i class="fa fa-filter fa-lg"></i>
			  	<?php echo t("Organizations"); ?>
			  	<a href="javascript:firstLoad()" class="clear-all-link"><?php echo t("Clear all"); ?></a>
			  </div>
		  	  <ul class="list-group">
				<li class="list-group-item text-muted"><?php echo t("There are no organizations that match this search"); ?></li>
			  </ul>
	      </div>
		  <div id="panel-groups" class="panel panel-default ckan-filter-panel">
			  <div class="panel-heading">
			  	<i class="fa fa-filter fa-lg"></i>
			  	<?php echo t("groups"); ?>
			  	<a href="javascript:firstLoad()" class="clear-all-link"><?php echo t("Clear all"); ?></a>
			  </div>
			  <ul class="list-group">
				<li class="list-group-item text-muted"><?php echo t("There are no organizations that match this search"); ?></li>
			  </ul>
	      </div>
		  <div id="panel-tags" class="panel panel-default ckan-filter-panel">
			  <div class="panel-heading">
			  	<i class="fa fa-filter fa-lg"></i>
			  	<?php echo t("tags"); ?>
			  	<a href="javascript:firstLoad()" class="clear-all-link"><?php echo t("Clear all"); ?></a>
			  </div>
			  <ul class="list-group">
				<li class="list-group-item text-muted"><?php echo t("There are no organizations that match this search"); ?></li>
			  </ul>
	      </div>
		  <div id="panel-formats" class="panel panel-default ckan-filter-panel">
			  <div class="panel-heading">
			  	<i class="fa fa-filter fa-lg"></i>
			  	<?php echo t("formats"); ?>
			  </div>
			  <ul class="list-group">
				<li class="list-group-item text-muted"><?php echo t("There are no organizations that match this search"); ?></li>
			  </ul>
	      </div>
		  <div id="panel-licenses" class="panel panel-default ckan-filter-panel">
			  <div class="panel-heading">
			  	<i class="fa fa-filter fa-lg"></i>
			  	<?php echo t("licenses"); ?>
			  </div>
			  <ul class="list-group">
				<li class="list-group-item text-muted"><?php echo t("There are no organizations that match this search"); ?></li>
			  </ul>
	      </div>
	  </div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="loading-dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1><?php echo t("Searching datasets..."); ?></h1>
				</div>
				<div class="modal-body">
					<div class="progress progress-striped active">
					  <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						<span class="sr-only">100% Complete</span>
					  </div>
					</div>
				</div>
			</div>
		</div>
</div>
