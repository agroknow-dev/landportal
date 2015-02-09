<div class="content main-content container">
  <div class="row">
    <div class="col-sm-9">
      <form id="run-query" role="form">
	<div class="form-group">
	  <label for="namespace"><?php echo t('Default Namespace'); ?></label>
	  <input type="text" name="default-graph-uri" class="form-control" id="namespace" value="<?php echo $data['namespace']; ?>" placeholder="<?php echo t('Default Namespace'); ?>">
	</div>
	<div class="form-group">
	  <label for="query"><?php echo t('Query'); ?></label>
	  <textarea name="query" class="form-control query" id="query"><?php echo $data['query']; ?></textarea>
	</div>
	<div class="form-group">
	  <label for="format"><?php echo t('Format'); ?>:</label>
	  <select id="format" name="format">
	    <option value="text/html" selected="selected">HTML</option>
	    <option value="application/vnd.ms-excel">Spreadsheet</option>
	    <option value="application/sparql-results+xml">XML</option>
	    <option value="json">JSON</option>
	    <option value="application/javascript">Javascript</option>
	    <option value="text/plain">NTriples</option>
	    <option value="application/rdf+xml">RDF/XML</option>
	  </select>
	</div>
	<button class="btn data-button">
	  <?php echo t('Run query'); ?>
	</button>
      </form>
      <div id="query-result-html" class="query-result-html"><?php echo $data['html']; ?></div>
      <div id="query-result" class="query-result">
        <pre class="prettyprint lang-<? echo $data['language']; ?>"><? echo $data['result']; ?></pre>
      </div>
      <h2 class="section"><span><?php echo t('Query examples'); ?></span></h2>

      <h3 class="example"><?php echo t('List all topics'); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;

select * where
{
 ?topic rdf:type lbonto:Topic .
}
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX lbonto: <http://purl.org/weso/landbook/ontology#> select * where { ?topic rdf:type lbonto:Topic .}" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>



  <h3 class="example"><?php echo t('Print every available information for each topic'); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;

select ?topic, ?predicate, ?object where
      ?topic rdf:type lbonto:Topic .
      ?topic ?predicate ?object .
    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf:
	<http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX lbonto:
	<http://purl.org/weso/landbook/ontology#> select ?topic,
	?predicate, ?object where { ?topic rdf:type lbonto:Topic . ?topic ?predicate ?object .}" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>


<h3 class="example"><?php echo t('All indicators'); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX rdfs: &lt;http://www.w3.org/2000/01/rdf-schema#&gt;

select * where
    {
      ?indicator rdf:type cex:Indicator .
      ?indicator rdfs:label ?name .
    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX cex: <http://purl.org/weso/computex/ontology#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> select * where { ?indicator rdf:type cex:Indicator . ?indicator rdfs:label ?name .}" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>


  <h3 class="example"><?php echo t("Print name and description of every indicator that has 'LAND_USE' as topic"); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX rdfs:&lt;http://www.w3.org/2000/01/rdf-schema#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;
PREFIX base-topic: &lt;http://book.landportal.org/topic/&gt;

 select ?indicator, ?name, ?description  where
    {
      ?indicator rdf:type cex:Indicator .
      ?indicator lbonto:topic base-topic:LAND_USE .
      ?indicator rdfs:label ?name .
      ?indicator rdfs:comment ?description .
    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#> PREFIX cex: <http://purl.org/weso/computex/ontology#> PREFIX lbonto: <http://purl.org/weso/landbook/ontology#> PREFIX base-topic: <http://book.landportal.org/topic/> select ?indicator, ?name, ?description  where { ?indicator rdf:type cex:Indicator . ?indicator lbonto:topic base-topic:LAND_USE . ?indicator rdfs:label ?name . ?indicator rdfs:comment ?description . }" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>


<h3 class="example"><?php echo t("URL of the page in FAO's portal of every African country stored in the system"); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX rdfs: &lt;http://www.w3.org/2000/01/rdf-schema#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;
PREFIX base: &lt;http://book.landportal.org/&gt;

 select ?iso3, ?name, ?url where
    {
      ?country rdf:type cex:Area .
      ?country lbonto:iso3 ?iso3 .
      ?country lbonto:is_part_of base:Africa .
      ?country rdfs:label ?name .
      ?country lbonto:faoURI ?url .

    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX cex: <http://purl.org/weso/computex/ontology#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> PREFIX lbonto: <http://purl.org/weso/landbook/ontology#> PREFIX base: <http://book.landportal.org/> select ?iso3, ?name, ?url where { ?country rdf:type cex:Area . ?country lbonto:iso3 ?iso3 . ?country lbonto:is_part_of base:Africa . ?country rdfs:label ?name . ?country lbonto:faoURI ?url . }" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>



   <h3 class="example"><?php echo t("URL of the page in FAO's portal of every African country that has at least a deal in the industrial sector"); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX rdfs:&lt;http://www.w3.org/2000/01/rdf-schema#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;
PREFIX qb: &lt;http://purl.org/linked-data/cube#&gt;
PREFIX base: &lt;http://book.landportal.org/&gt;
PREFIX base-ind: &lt;http://book.landportal.org/indicator/&gt;

 select ?iso3, ?name, ?url where
    {
      ?country rdf:type cex:Area ;
               lbonto:iso3 ?iso3 ;
               lbonto:is_part_of base:Africa ;
               rdfs:label ?name ;
               lbonto:faoURI ?url .

      ?obs cex:ref-area ?country ;
           rdf:type qb:Observation ;
           cex:ref-indicator base-ind:INDLM4 ;
           cex:value ?value ;

      FILTER(?value &gt; 0) .

    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX cex: <http://purl.org/weso/computex/ontology#> PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#> PREFIX lbonto: <http://purl.org/weso/landbook/ontology#> PREFIX qb: <http://purl.org/linked-data/cube#> PREFIX base: <http://book.landportal.org/> PREFIX base-ind: <http://book.landportal.org/indicator/> select ?iso3, ?name, ?url where  { ?country rdf:type cex:Area ; lbonto:iso3 ?iso3 ; lbonto:is_part_of base:Africa ; rdfs:label ?name ; lbonto:faoURI ?url . ?obs cex:ref-area ?country ; rdf:type qb:Observation ; cex:ref-indicator base-ind:INDLM4 ; cex:value ?value ; FILTER(?value > 0) . }" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>

<h3 class="example"><?php echo t("URL of the page in FAO's portal of every country that has some observation obtained from the organization called 'UNDP: United Nations Development Program'"); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX rdfs: &lt;http://www.w3.org/2000/01/rdf-schema#&gt;
PREFIX lbonto: &lt;http://purl.org/weso/landbook/ontology#&gt;
PREFIX qb: &lt;http://purl.org/linked-data/cube#&gt;
PREFIX w3: &lt;http://www.w3.org/ns/org#&gt;
PREFIX : &lt;http://book.landportal.org/&gt;

 select ?iso3, ?name, ?url where
    {
      ?country rdf:type cex:Area ;
               lbonto:iso3 ?iso3 ;
               rdfs:label ?name ;
               lbonto:faoURI ?url .

      ?obs cex:ref-area ?country ;
           rdf:type qb:Observation ;
           qb:dataSet ?dataset .

      ?dataset rdf:type qb:DataSet ;
               lbonto:dataSource ?datasource.

      ?datasource rdf:type lbonto:DataSource ;
                  lbonto:organization ?org .

      ?org rdf:type w3:Organization ;
           rdfs:label &quot;UNDP: United Nations Development Programme&quot; .
    }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> PREFIX cex: <http://purl.org/weso/computex/ontology#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> PREFIX lbonto: <http://purl.org/weso/landbook/ontology#> PREFIX qb: <http://purl.org/linked-data/cube#> PREFIX w3: <http://www.w3.org/ns/org#> PREFIX : <http://book.landportal.org/> select ?iso3, ?name, ?url where { ?country rdf:type cex:Area ; lbonto:iso3 ?iso3 ; rdfs:label ?name ; lbonto:faoURI ?url .  ?obs cex:ref-area ?country ; rdf:type qb:Observation ; qb:dataSet ?dataset . ?dataset rdf:type qb:DataSet ; lbonto:dataSource ?datasource. ?datasource rdf:type lbonto:DataSource ; lbonto:organization ?org . ?org rdf:type w3:Organization ; rdfs:label &quot;UNDP: United Nations Development Programme&quot; . }" />
	<input type="hidden" name="format" value="json" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>

   <h3 class="example"><?php echo t("Country, year and value of every observation of 2010 or more recent that has INDUNDP0 as indicator"); ?></h3>
			<pre class="prettyprint lang-sql">
PREFIX rdf: &lt;http://www.w3.org/1999/02/22-rdf-syntax-ns#&gt;
PREFIX cex: &lt;http://purl.org/weso/computex/ontology#&gt;
PREFIX rdfs:&lt;http://www.w3.org/2000/01/rdf-schema#&gt;
PREFIX qb: &lt;http://purl.org/linked-data/cube#&gt;
PREFIX base-ind: &lt;http://book.landportal.org/indicator/&gt;

 select ?country_name, ?year, ?value where
       {
         ?obs rdf:type qb:Observation ;
              cex:value ?value        ;
              cex:ref-time ?date      ;
              cex:ref-indicator base-ind:INDUNDP0;
              cex:ref-area ?country   .


         ?country rdf:type cex:Area   ;
                  rdfs:label ?country_name    .

         ?date cex:year ?year .

         FILTER (?year &gt; 2011)

       }
</pre>
<form>
	<input type="hidden" name="default-graph-uri" value="http://book.landportal.org" />
	<input type="hidden" name="query" value="select ?country_name, ?year, ?value where { ?obs rdf:type qb:Observation ; cex:value ?value ; cex:ref-time ?date ; cex:ref-indicator base-ind:INDUNDP0 ; cex:ref-area ?country. ?country rdf:type cex:Area ; rdfs:label ?country_name . ?date cex:year ?year . FILTER (?year &gt; 2011) }" />
	<button class="btn data-button"><?php echo t('Test query'); ?></button>
</form>


		</div>
		<div class="col-sm-3">
			<a href="/book/widgets">
				<button class="btn data-button">
   <?php echo t('Create your data widgets'); ?>
				</button>
			</a>
			<a href="/book/catalog">
				<button class="btn data-button">
					<?php echo t('Browse data at the catalog'); ?>
				</button>
			</a>
			<a href="/wesby">
				<button class="btn data-button">
					<?php echo t('Linked Data browser'); ?>
				</button>
			</a>
			<a href="http://weso.github.io/landportalDoc/model/domain/">
				<button class="btn data-button">
					<?php echo t('Data Model documentation'); ?>
				</button>
			</a>
			<a href="http://weso.github.io/landportal-data-access-api/">
				<button class="btn data-button">
					<?php echo t('API Documentation Access'); ?>
				</button>
			</a>
			<!--a href="/book/catalog">
				<button class="btn data-button">
					<?php echo t('Direct Data Download'); ?>
				</button>
			</a-->
		</div>
	</div>
</div>
