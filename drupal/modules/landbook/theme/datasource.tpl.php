<div class="content main-content container">
   <h1 class="country-name datasource-name"><span><?php echo $data['info']['name']; ?></span></h1>
	<div class="row data-source">
		<div class="col-sm-9">
			<img class="source-logo" alt="" src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/sources/<?php echo $data['info']['id']; ?>.png" />
   <?php echo $data['info']['description']; ?>

			<div class="row source-indicators">
<?php foreach ($data['selectors']['indicators'] as $i): ?>
							<div class="col-sm-6">
								<h3><a href="/book/indicators/detail?indicator=<?php echo $i['id']; ?>"><?php echo $i['name']; ?></a></h3>
								<p class="description"><?php echo $i['description']; ?></p>
								<p><span class="text-primary"><?php echo t("Format"); ?>:</span> <?php echo $i['format']; ?></p>
								<p><span class="text-primary"><?php echo t("Last updated"); ?>:</span> <?php echo $i['last_update']; ?></p>
							</div>
<?php endforeach; /* indicators */ ?>
			</div>
		</div>
		<div class="col-sm-3">
			<h2 class="section"><span><?php echo t("On this source"); ?></span></h2>
			<ul class="indicator-list">
<?php foreach ($data['selectors']['indicators'] as $i): ?>
						<li><a href="/book/indicators/detail?indicator=<?php echo $i['id']; ?>"><?php echo $i['name']; ?></a></li>
<?php endforeach; /* indicators */ ?>
			</ul>
			<h2 class="section"><span><?php echo t("Other sources"); ?></span></h2>
				<select id="source-selector" class="form-control">
					<option disabled="disabled" selected="true"><?php echo t("Select one"); ?></option>
<?php foreach ($data['selectors']['data-sources'] as $i): ?>
						<option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; /* data-sources */ ?>
				</select>
		</div>
	</div>
</div>

