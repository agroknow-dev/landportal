  <div class="row">
    <div class="col-sm-9">
<?php foreach ($data['topics'] as $c): ?>
      <h2 class="section"><span><?php echo $c['name']; ?></span></h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th><?php echo t("Indicator"); ?></th>
            <th><?php echo t("Value"); ?></th>
            <th><?php echo t("Last updated"); ?></th>
            <th><?php echo t("Source"); ?></th>
            </tr>
          </thead>
        <tbody>
<?php foreach ($c['indicators'] as $i): ?>
          <tr>
            <td><?php echo $i['name']; ?></td>
            <td><?php echo $i['value']; ?></td>
            <td><?php echo $i['last_update']; ?></td>
            <td><?php echo $i['source']; ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
<?php endforeach; ?>
    </div>

    <div class="col-sm-3">
      <h2 class="section"><span><?php echo t("Specific country"); ?></span></h2>
			<select id="country-select" class="form-control">
				<option disabled="disabled" selected="true"><?php echo t("Select one"); ?></option>
<?php foreach ($data['selectors']['countries'] as $c): ?>
					<option value="<?php echo $c['iso3']; ?>"><?php echo $c['name']; ?></option>
<?php endforeach; ?>
			</select>
			<a href="" class="more-info"><?php echo t("More about areas and countries"); ?></a>
			<a href="
			/sparql?default-graph-uri=http%3A%2F%2Fbook.landportal.org&query=PREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+cex%3A+%3Chttp%3A%2F%2Fpurl.org%2Fweso%2Fcomputex%2Fontology%23%3E%0D%0APREFIX+lbonto%3A+%3Chttp%3A%2F%2Fpurl.org%2Fweso%2Flandbook%2Fontology%23%3E%0D%0APREFIX+qb%3A+%3Chttp%3A%2F%2Fpurl.org%2Flinked-data%2Fcube%23%3E%0D%0APREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+time%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2006%2Ftime%23%3E%0D%0A%0D%0A%0D%0ASELECT+%3Fiso3%2C+%3Find_name%2C+%3Fvalue%2C+%3Fstart_time%2C+%3Fend_time%2C+%3Fissued+WHERE%0D%0A%0D%0A%7B%0D%0A+++%3Fcountry+rdf%3Atype+cex%3AArea%3B%0D%0A++++++++++++lbonto%3Aiso3+%3Fiso3%3B%0D%0A++++++++++++lbonto%3Aiso3+%22<?php echo $data['info']['iso3']; ?>%22.++%23+Substitute+%22<?php echo $data['info']['iso3']; ?>%22+by+the+desired+iso3%0D%0A%0D%0A+++%3Fobs+cex%3Aref-area+%3Fcountry%3B%0D%0A++++++++rdf%3Atype+qb%3AObservation%3B%0D%0A++++++++cex%3Avalue+%3Fvalue%3B%0D%0A++++++++dcterms%3Aissued+%3Fissued%3B%0D%0A++++++++cex%3Aref-time+%3Fa_time%3B%0D%0A++++++++cex%3Aref-indicator+%3Fa_indicator.%0D%0A%0D%0A+++%3Fa_indicator+rdf%3Atype+cex%3AIndicator+%3B%0D%0A++++++++++++++++rdfs%3Alabel+%3Find_name+.%0D%0A%0D%0A+++%3Fa_time+rdf%3Atype+time%3ADateTimeInterval+%3B%0D%0A+++++++++++time%3AhasBeginning+%3Fa_beginning_time+%3B%0D%0A+++++++++++time%3AhasEnd+%3Fan_end_time+.%0D%0A%0D%0A++++%3Fa_beginning_time+rdf%3Atype+time%3AInstant+%3B%0D%0A++++++++++++++++++++++time%3AinXSDDateTime+%3Fstart_time.%0D%0A%0D%0A++++%3Fan_end_time+rdf%3Atype+time%3AInstant+%3B%0D%0A+++++++++++++++++time%3AinXSDDateTime+%3Fend_time+.%0D%0A%0D%0A%0D%0A%7D+ORDER+BY+ASC%28%3Find_name%29&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on
			">
			<button class="btn data-button"><?php echo t("Download all data for"); ?><br />
                        <?php echo $data['info']['name']; ?></button
			</a>
			<button class="btn data-button-coming button-margin"><?php echo t("Consult the legacy Library"); ?><br />
                          <?php /*echo $data['info']['name'];*/ ?>
				<p><strong>(<?php echo t("Coming soon"); ?>)</strong></p></button>
			<a href="/search/site/<?php echo $data['info']['name']; ?> AND debate">
				<button class="btn data-button-dark"><?php echo t("Debate with others about"); ?><br/>
                                <?php echo $data['info']['name']; ?></button>
			</a>
		</div>
	</div>
