<?php
/*
Template Name: Map Box Page
*/

get_header();?>
<script type='text/javascript' src='http://www.climbsf.com/wp-includes/js/jquery/jquery.js?ver=1.11.2'></script>
    <script type="text/javascript" src="http://www.climbsf.com/wp-content/themes/realestate/includes/js/plugins/jquery-scrollspy.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/v3.0.1/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v3.0.1/mapbox.css' rel='stylesheet' />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
	<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial;
    }
    .map-scroller{
		display: none !important;
	}
    
    .map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
    
    .map-scroller {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 30%;
        opacity: 0;
        overflow-x: hidden;
        overflow-y: scroll;
        margin: 0 40px;
        z-index: 99;
        -webkit-transition: opacity .5s linear;
        transition: opacity .5s linear;
    }
    
    .map-scroller .map-scroller-item:first-child {
        margin-top: 90%;
    }
    
    .map-scroller .map-scroller-item {
        padding: 10px;
        background-color: #fff;
        margin: 20px 4px;
        -webkit-box-shadow: 1px 1px 5px rgba(0, 0, 0, .4);
        box-shadow: 1px 1px 5px rgba(0, 0, 0, .4);
    }
    
    .map-scroller .map-scroller-item .img {
        height: 280px;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
    
    .map-scroller::-webkit-scrollbar {
        display: none;
    }
    
    .close {
        width: 48px;
        height: 48px;
        position: absolute;
        top: 10px;
        right: 45px;
        z-index: 9;
        box-shadow: none;
        background-color: rgba(255, 255, 255, .8);
        border: none;
        font-size: 21px;
        cursor: pointer;
    }
    
    .center-wrap {
        background-color: rgba(0, 0, 0, .75);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-transition: background-color .5s linear;
        transition: background-color .5s linear;
        z-index: 9999;
    }
    
    .wrapArea {
        width: 100%;
        position: relative;
        height: 500px;
    }
    
    .makeFull {
        /*position: fixed;
        top: 50px;
        height: 100%;
        bottom: 0;*/
        width:100%;
        height:500px;
        
    }
    
    button.explore {
        background-color: #000;
        border: none;
        color: #fff;
        padding: 12px 18px;
        display: inline-block;
        width: auto;
        font-size: 18px;
        font-weight: 100;
        margin: 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
        -webkit-transition: all .5s cubic-bezier(.19, 1, .22, 1);
        transition: all .5s cubic-bezier(.19, 1, .22, 1);
        cursor: pointer;
    }
    
    .explore:hover {
        padding: 22px 28px;
    }
    
    h3 {
        text-transform: uppercase;
        text-align: center;
        margin: 40px;
        font-size: 24px;
        color: #fff;
        letter-spacing: 2px;
    }
    
    .center {
        text-align: center;
    }
    </style>

<?php
$arr = array();


$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'event',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$i=0;
$input = array();
foreach($recent_posts as $recent_post)
{
	$geoloaction = array(
 'type'=>"Feature",
 
);
	$lat = get_post_meta($recent_post['ID'],'wpcf-latitude',true);
	
	$long = get_post_meta($recent_post['ID'],'wpcf-longitude',true);
	
	
	$geoloaction['geometry']['type'] = 'Point';
    $geoloaction['geometry']['coordinates'] = array(
         '0'=> $lat,
         '1'=> $long

    ); 
	
	
	$geoloaction['properties']['description'] = $recent_post['post_title'];
	
	$geoloaction['properties']['icon'] = array(
        "iconUrl"=> "http://www.climbsf.com/wp-content/themes/realestate/includes/images/marker-small.png",
                "iconSize"=> [35, 51], // size of the icon
                "iconAnchor"=> [17.5, 51], // point of the icon which will correspond to marker's location
                "popupAnchor"=> [0, -51], // point from which the popup should open relative to the iconAnchor
                "className"=> "dot"
    );
    
    $arr[$i] = $geoloaction;
	$i++;
}


//print_r($arr);

$geoloactions = $arr;

$json = json_encode($geoloactions); ?>


<div class="wrapArea">
        <div class="center-wrap" style="display: flex;">
            <div class="center">
                <h3>Discover Buildings In This Area</h3>
                <button class="explore">Explore</button>
            </div>
        </div>
        <div class="map-scroller">
            <div class="holder">
                <div class="map-scroller-item" id="the-towers" data-lat="37.78069" data-lon="-122.38922">
                    <a href="http://www.climbsf.com/buildings/the-towers/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/88-king-stock-011.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-towers/">The Towers</a></h4>
                    <div class="tagline">88 King St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="950-harrison-st" data-lat="37.778354" data-lon="-122.403168">
                    <a href="http://www.climbsf.com/buildings/950-harrison-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/950-harrison-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/950-harrison-st/">950 Harrison St.</a></h4>
                    <div class="tagline">950 Harrison St. San Francisco, CA </div>
                </div>
                <div class="map-scroller-item" id="1440-broadway-st" data-lat="37.796387" data-lon="-122.420728">
                    <a href="http://www.climbsf.com/buildings/1440-broadway-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/1440-broadway-05.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/1440-broadway-st/">1440 Broadway St.</a></h4>
                    <div class="tagline">1440 Broadway St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="lighthouse-lofts" data-lat="37.77791" data-lon="37.77791">
                    <a href="http://www.climbsf.com/buildings/lighthouse-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/lighthouse-lofts-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/lighthouse-lofts/">Lighthouse Lofts</a></h4>
                    <div class="tagline">1097 Howard St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="bella-vista-lofts" data-lat="37.756001" data-lon="-122.41256">
                    <a href="http://www.climbsf.com/buildings/bella-vista-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/bella-vista-lofts-2900-22nd-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/bella-vista-lofts/">Bella Vista Lofts</a></h4>
                    <div class="tagline">2900 22nd St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-theatre-lofts" data-lat="37.772186" data-lon="-122.431516">
                    <a href="http://www.climbsf.com/buildings/the-theatre-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/the-theatre-lofts-560-haight-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-theatre-lofts/">The Theatre Lofts</a></h4>
                    <div class="tagline">560 Haight St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="1325-indiana-st" data-lat="37.753704" data-lon="-122.390279">
                    <a href="http://www.climbsf.com/buildings/1325-indiana-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/1325-indiana-st-stock-03.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/1325-indiana-st/">1325 Indiana St.</a></h4>
                    <div class="tagline">1325 Indiana St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="cubix" data-lat="37.781655" data-lon="-122.399135">
                    <a href="http://www.climbsf.com/buildings/cubix/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/05/cubix-766-harrison-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/cubix/">Cubix</a></h4>
                    <div class="tagline">766 Harrison St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="870-harrison-st" data-lat="37.779743" data-lon="-122.401357">
                    <a href="http://www.climbsf.com/buildings/870-harrison-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/04/870-harrison-st-stock-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/870-harrison-st/">870 Harrison St.</a></h4>
                    <div class="tagline">870 Harrison St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="post-international" data-lat="37.785794" data-lon="-122.424669">
                    <a href="http://www.climbsf.com/buildings/post-international/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/03/post-international-1388-gough-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/post-international/">Post International</a></h4>
                    <div class="tagline">1388 Gough St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-sutterfield" data-lat="37.786774" data-lon="-122.424136">
                    <a href="http://www.climbsf.com/buildings/the-sutterfield/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/03/the-sutterfield-1483-sutter-st-durwin-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-sutterfield/">The Sutterfield</a></h4>
                    <div class="tagline">1483 Sutter St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="daniel-burnham-court" data-lat="37.786774" data-lon="-122.422491">
                    <a href="http://www.climbsf.com/buildings/daniel-burnham-court/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/03/1-daniel-burnham-ct-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/daniel-burnham-court/">Daniel Burnham Court</a></h4>
                    <div class="tagline">1 Daniel Burnham Ct. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="seventy2-townsend" data-lat="37.781259" data-lon="-122.390213">
                    <a href="http://www.climbsf.com/buildings/seventy2-townsend/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2017/01/seventytwo-townsend-72-townsend-st-024.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/seventy2-townsend/">Seventy2 Townsend</a></h4>
                    <div class="tagline">72 Townsend St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="axis-sf" data-lat="37.788725770969" data-lon="-122.41846561432">
                    <a href="http://www.climbsf.com/buildings/axis-sf/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2016/05/axis-sf-1299-bush-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/axis-sf/">Axis SF</a></h4>
                    <div class="tagline">1299 Bush St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="1099-23rd-st" data-lat="37.75510841352" data-lon="-122.39039897919">
                    <a href="http://www.climbsf.com/buildings/1099-23rd-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2016/05/1099-23rd-st-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/1099-23rd-st/">1099 23rd St.</a></h4>
                    <div class="tagline">1099 23rd St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="2130-harrison-st" data-lat="37.762869579118" data-lon="-122.41314411163">
                    <a href="http://www.climbsf.com/buildings/2130-harrison-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/06/2130-harrison-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/2130-harrison-st/">2130 Harrison St.</a></h4>
                    <div class="tagline">2130 Harrison St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="sapphire" data-lat="37.774127" data-lon="-122.412521">
                    <a href="http://www.climbsf.com/buildings/sapphire/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/09/sapphire-252-9th-st-013.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/sapphire/">Sapphire</a></h4>
                    <div class="tagline">252 9th St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="bridgeview" data-lat="37.787067" data-lon="-122.391128">
                    <a href="http://www.climbsf.com/buildings/bridgeview/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/07/bridgeview-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/bridgeview/">Bridgeview</a></h4>
                    <div class="tagline">400 Beale St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-crown-towers" data-lat="37.787933" data-lon="-122.41289">
                    <a href="http://www.climbsf.com/buildings/the-crown-towers/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/06/crown-towers-03.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-crown-towers/">The Crown Towers</a></h4>
                    <div class="tagline">666 Post St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-royal" data-lat="37.792231" data-lon="-122.401228">
                    <a href="http://www.climbsf.com/buildings/the-royal/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/07/201-sansome-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-royal/">The Royal</a></h4>
                    <div class="tagline">201 Sansome St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="one-hawthorne" data-lat="37.785736" data-lon="-122.398952">
                    <a href="http://www.climbsf.com/buildings/one-hawthorne/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2015/06/1-hawthorne-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/one-hawthorne/">One Hawthorne</a></h4>
                    <div class="tagline">1 Hawthorne St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="1207-indiana-st" data-lat="37.754828487416" data-lon="-122.39059209824">
                    <a href="http://www.climbsf.com/buildings/1207-indiana-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/04/1207-indiana-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/1207-indiana-st/">1207 Indiana St.</a></h4>
                    <div class="tagline">1207 Indiana St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="300-ivy-st" data-lat="37.777438" data-lon="-122.42343">
                    <a href="http://www.climbsf.com/buildings/300-ivy-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/04/300-ivy-st-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/300-ivy-st/">300 Ivy St.</a></h4>
                    <div class="tagline">300 Ivy St. &amp; 401 Grove St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="18-lansing-st" data-lat="37.786363" data-lon="-122.393867">
                    <a href="http://www.climbsf.com/buildings/18-lansing-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/01/18-lansing-08b.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/18-lansing-st/">18 Lansing St.</a></h4>
                    <div class="tagline">18 Lansing St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="299-valencia" data-lat="37.768269" data-lon="-122.422078">
                    <a href="http://www.climbsf.com/buildings/299-valencia/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/01/299-Valencia-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/299-valencia/">299 Valencia</a></h4>
                    <div class="tagline">299 Valencia St. &amp; 380 14th St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="555-bartlett-st" data-lat="37.748364" data-lon="-122.419109">
                    <a href="http://www.climbsf.com/buildings/555-bartlett-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/01/555-bartlett-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/555-bartlett-st/">555 Bartlett St.</a></h4>
                    <div class="tagline">555 Bartlett St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="madrone" data-lat="37.771588" data-lon="-122.388536">
                    <a href="http://www.climbsf.com/buildings/madrone/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2012/01/madrone-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/madrone/">Madrone</a></h4>
                    <div class="tagline">435 China Basin St., 420 Mission Bay Blvd. North, &amp; 480 Mission Bay Blvd. North San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-watermark" data-lat="37.786292333282" data-lon="-122.3891222477">
                    <a href="http://www.climbsf.com/buildings/the-watermark/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/watermark-501-beale-st-12.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-watermark/">The Watermark</a></h4>
                    <div class="tagline">501 Beale St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-lansing" data-lat="37.786012525205" data-lon="-122.39422917366">
                    <a href="http://www.climbsf.com/buildings/the-lansing/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/the-lansing-50-lansing-st-012.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-lansing/">The Lansing</a></h4>
                    <div class="tagline">50 Lansing St., San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-infinity" data-lat="37.789429502819" data-lon="-122.39103198051">
                    <a href="http://www.climbsf.com/buildings/the-infinity/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/infinity-stock-015.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-infinity/">The Infinity</a></h4>
                    <div class="tagline">301 Main St., 333 Main St., 318 Spear St., &amp; 338 Spear St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="beacon" data-lat="37.777431" data-lon="-122.393707">
                    <a href="http://www.climbsf.com/buildings/beacon/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/beacon-250-260-king-st-09.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/beacon/">The Beacon</a></h4>
                    <div class="tagline">250 King St. &amp; 260 King St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="shipley-square" data-lat="37.781493054084" data-lon="-122.40151941776">
                    <a href="http://www.climbsf.com/buildings/shipley-square/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/821-folsom-st-shipley-square-091.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/shipley-square/">Shipley Square</a></h4>
                    <div class="tagline">821 Folsom St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="350-alabama-st" data-lat="37.764762" data-lon="-122.412569">
                    <a href="http://www.climbsf.com/buildings/350-alabama-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/350-alabama-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/350-alabama-st/">350 Alabama St.</a></h4>
                    <div class="tagline">350 Alabama St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="175-bluxome" data-lat="37.774484359568" data-lon="-122.39969551563">
                    <a href="http://www.climbsf.com/buildings/175-bluxome/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/175-bluxome-stock-04.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/175-bluxome/">175 Bluxome</a></h4>
                    <div class="tagline">175 Bluxome St. San Francisco CA</div>
                </div>
                <div class="map-scroller-item" id="the-palms" data-lat="37.779089" data-lon="-122.39713">
                    <a href="http://www.climbsf.com/buildings/the-palms/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/the-palms-555-4th-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-palms/">The Palms</a></h4>
                    <div class="tagline">555 4th St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="arterra" data-lat="37.77393" data-lon="-122.396241">
                    <a href="http://www.climbsf.com/buildings/arterra/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/arterra-300-berry-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/arterra/">Arterra</a></h4>
                    <div class="tagline">300 Berry St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="symphony-towers" data-lat="37.78245971842" data-lon="-122.4204826355">
                    <a href="http://www.climbsf.com/buildings/symphony-towers/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/symphony-towers-650-turk-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/symphony-towers/">Symphony Towers</a></h4>
                    <div class="tagline">750 Van Ness Ave. &amp; 650 Turk St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-potrero" data-lat="37.76385" data-lon="-122.403242">
                    <a href="http://www.climbsf.com/buildings/the-potrero/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/451-kansas-stock-011.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-potrero/">The Potrero</a></h4>
                    <div class="tagline">451 Kansas St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="park-terrace" data-lat="37.773623596886" data-lon="-122.39582777023">
                    <a href="http://www.climbsf.com/buildings/park-terrace/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/325-berry-131.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/park-terrace/">Park Terrace</a></h4>
                    <div class="tagline">325 Berry St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="soma-grand" data-lat="37.77839" data-lon="-122.412238">
                    <a href="http://www.climbsf.com/buildings/soma-grand/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/1160-mission-stock-3-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/soma-grand/">SOMA Grand</a></h4>
                    <div class="tagline">1160 Mission St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-hayes" data-lat="37.773982" data-lon="-122.421936">
                    <a href="http://www.climbsf.com/buildings/the-hayes/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/The-Hayes-55-Page-St-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-hayes/">The Hayes</a></h4>
                    <div class="tagline">55 Page St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="235-berry" data-lat="37.774759971117" data-lon="-122.3942399025">
                    <a href="http://www.climbsf.com/buildings/235-berry/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/235-berry-stock-03.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/235-berry/">235 Berry</a></h4>
                    <div class="tagline">235 Berry St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="88-townsend" data-lat="37.780812" data-lon="-122.390504">
                    <a href="http://www.climbsf.com/buildings/88-townsend/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/88-townsend-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/88-townsend/">88 Townsend</a></h4>
                    <div class="tagline">88 Townsend St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-millennium-tower" data-lat="37.790505" data-lon="-122.396252">
                    <a href="http://www.climbsf.com/buildings/the-millennium-tower/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/millennium-tower-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-millennium-tower/">The Millennium Tower</a></h4>
                    <div class="tagline">301 Mission St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-montgomery" data-lat="37.788098341741" data-lon="-122.40104198456">
                    <a href="http://www.climbsf.com/buildings/the-montgomery/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/the-montgomery-74-new-montgomery-st-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-montgomery/">The Montgomery</a></h4>
                    <div class="tagline">74 New Montgomery St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="esprit-park" data-lat="37.760255" data-lon="-122.390441">
                    <a href="http://www.climbsf.com/buildings/esprit-park/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/esprit-park-stock-08.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/esprit-park/">Esprit Park</a></h4>
                    <div class="tagline">800-900 Minnesota St., 801-895 Indiana St., 901-989 20th St. San Francisco CA</div>
                </div>
                <div class="map-scroller-item" id="four-seasons-residences" data-lat="37.786444955422" data-lon="-122.40448594093">
                    <a href="http://www.climbsf.com/buildings/four-seasons-residences/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/four-seasons-765-market-st-08.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/four-seasons-residences/">Four Seasons Residences</a></h4>
                    <div class="tagline">765 Market St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="museum-parc" data-lat="37.783485725508" data-lon="-122.39899277687">
                    <a href="http://www.climbsf.com/buildings/museum-parc/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/museum-parc-300-3rd-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/museum-parc/">Museum Parc</a></h4>
                    <div class="tagline">300 3rd St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-mint-collection" data-lat="37.783128" data-lon="-122.407763">
                    <a href="http://www.climbsf.com/buildings/the-mint-collection/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/2-mint-plaza-stock-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-mint-collection/">The Mint Collection</a></h4>
                    <div class="tagline">2 Mint Plz., 6 Mint Plz., 8 Mint Plz., &amp; 10 Mint Plz. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="blu" data-lat="37.784818" data-lon="-122.396958">
                    <a href="http://www.climbsf.com/buildings/blu/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/blu-631-folsom-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/blu/">Blu</a></h4>
                    <div class="tagline">631 Folsom St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="829-folsom" data-lat="37.781251" data-lon="-122.401832">
                    <a href="http://www.climbsf.com/buildings/829-folsom/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/829-folsom-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/829-folsom/">829 Folsom</a></h4>
                    <div class="tagline">829 Folsom St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="radiance" data-lat="37.771838" data-lon="-122.38861">
                    <a href="http://www.climbsf.com/buildings/radiance/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/radiance-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/radiance/">Radiance</a></h4>
                    <div class="tagline">325 China Basin St. &amp; 330 Mission Bay Blvd. N. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="artani" data-lat="37.783203" data-lon="-122.420568">
                    <a href="http://www.climbsf.com/buildings/artani/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/artani-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/artani/">The Artani</a></h4>
                    <div class="tagline">818 Van Ness Ave. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="170-off-third" data-lat="37.778843" data-lon="-122.391489">
                    <a href="http://www.climbsf.com/buildings/170-off-third/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/170-off-third-177-townsend-st-and-170-king-st-24.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/170-off-third/">170 Off Third</a></h4>
                    <div class="tagline">177 Townsend St. &amp; 170 King St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="baycrest" data-lat="37.787737" data-lon="-122.390361">
                    <a href="http://www.climbsf.com/buildings/baycrest/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/201-harrison-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/baycrest/">Baycrest</a></h4>
                    <div class="tagline">201 Harrison St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="2600-18th-st" data-lat="37.762046849329" data-lon="-122.40848779678">
                    <a href="http://www.climbsf.com/buildings/2600-18th-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/2600-18th-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/2600-18th-st/">2600 18th St.</a></h4>
                    <div class="tagline">2600 18th St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="union-sf" data-lat="37.759334" data-lon="-122.409815">
                    <a href="http://www.climbsf.com/buildings/union-sf/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/2125-bryant-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/union-sf/">Union SF</a></h4>
                    <div class="tagline">2125 Bryant St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="1-ecker" data-lat="37.789935" data-lon="-117.398961">
                    <a href="http://www.climbsf.com/buildings/1-ecker/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/1-ecker-stock-011.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/1-ecker/">One Ecker</a></h4>
                    <div class="tagline">16 Jessie St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="cape-horn-lofts" data-lat="37.784409" data-lon="-122.391188">
                    <a href="http://www.climbsf.com/buildings/cape-horn-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/cape-horn-lofts-540-delancey-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/cape-horn-lofts/">Cape Horn Lofts</a></h4>
                    <div class="tagline">540 Delancey St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-clocktower" data-lat="37.783772" data-lon="-122.393748">
                    <a href="http://www.climbsf.com/buildings/the-clocktower/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/461-2nd-st-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-clocktower/">The Clocktower</a></h4>
                    <div class="tagline">461 2nd St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="harbor-lofts" data-lat="37.788382" data-lon="-122.389384">
                    <a href="http://www.climbsf.com/buildings/harbor-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/400-spear-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/harbor-lofts/">Harbor Lofts</a></h4>
                    <div class="tagline">400 Spear St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="potrero-square-lofts" data-lat="37.761315" data-lon="-122.390056">
                    <a href="http://www.climbsf.com/buildings/potrero-square-lofts/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/701-minnesota-st-02.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/potrero-square-lofts/">Potrero Square Lofts</a></h4>
                    <div class="tagline">701 Minnesota St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="255-berry-st" data-lat="37.774159" data-lon="-122.394754">
                    <a href="http://www.climbsf.com/buildings/255-berry-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/255-berry-stock-05.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/255-berry-st/">255 Berry St.</a></h4>
                    <div class="tagline">255 Berry St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="310-townsend-st" data-lat="37.777026" data-lon="-122.39574">
                    <a href="http://www.climbsf.com/buildings/310-townsend-st/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/310-townsend-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/310-townsend-st/">310 Townsend St.</a></h4>
                    <div class="tagline">310 Townsend St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="portside-i" data-lat="37.787337" data-lon="-122.388764">
                    <a href="http://www.climbsf.com/buildings/portside-i/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/portside-I-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/portside-i/">Portside I</a></h4>
                    <div class="tagline">38 Bryant St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-metropolitan" data-lat="37.787031" data-lon="-122.393642">
                    <a href="http://www.climbsf.com/buildings/the-metropolitan/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/metropolitan-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-metropolitan/">The Metropolitan</a></h4>
                    <div class="tagline">333 1st St. &amp; 355 1st St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="portside-ii" data-lat="37.788064" data-lon="-122.389825">
                    <a href="http://www.climbsf.com/buildings/portside-ii/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/portside-II-stock-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/portside-ii/">Portside II</a></h4>
                    <div class="tagline">403 Main St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="the-brannan" data-lat="37.783006" data-lon="-122.390247">
                    <a href="http://www.climbsf.com/buildings/the-brannan/">
                        <div class="img" style="background-image:url(http://www.climbsf.com/wp-content/uploads/2011/11/the-brannan-200-229-brannan-st-01.jpg);"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/the-brannan/">The Brannan</a></h4>
                    <div class="tagline">219 Brannan St., 229 Brannan St., &amp; 239 Brannan St. San Francisco, CA</div>
                </div>
                <div class="map-scroller-item" id="one-rincon-hill" data-lat="37.785721" data-lon="-122.392291">
                    <a href="http://www.climbsf.com/buildings/one-rincon-hill/">
                        <div class="img" style="background-image:url();"></div>
                    </a>
                    <h4><a href="http://www.climbsf.com/buildings/one-rincon-hill/">One Rincon Hill</a></h4>
                    <div class="tagline">425 1st St., 401 Harrison St., &amp; 489 Harrison St. San Francisco, CA</div>
                </div>
            </div>
        </div>
        <button class="close"><i class="fa fa-times"></i></button>
        <div id='map-one' class='map'> </div>
    </div>
    <?php
        $potol = '[{ 
        "type": "Feature",
        "geometry": {
            "type": "Point",
            "coordinates": [144.0561307, -37.8207879]
        },
        "properties": {
            "description": "Shourya-Chowdhury",
            "icon": {
                "iconUrl": "http:\/\/www.climbsf.com\/wp-content\/themes\/realestate\/includes\/images\/marker-small.png",
                "iconSize": [35, 51],
                "iconAnchor": [17.5, 51],
                "popupAnchor": [0, -51],
                "className": "dot"
            }
        }
    },
        { 
        "type": "Feature",
        "geometry": {
            "type": "Point",
            "coordinates": [144.9812606, -37.8199669]
        },
        "properties": {
            "description": "Shourya-Chowdhury",
            "icon": {
                "iconUrl": "http:\/\/www.climbsf.com\/wp-content\/themes\/realestate\/includes\/images\/marker-small.png",
                "iconSize": [35, 51],
                "iconAnchor": [17.5, 51],
                "popupAnchor": [0, -51],
                "className": "dot"
            }
        }
    },
    { 
        "type": "Feature",
        "geometry": {
            "type": "Point",
            "coordinates": [151.213108, -33.8567844]
        },
        "properties": {
            "description": "Shourya-Chowdhury",
            "icon": {
                "iconUrl": "http:\/\/www.climbsf.com\/wp-content\/themes\/realestate\/includes\/images\/marker-small.png",
                "iconSize": [35, 51],
                "iconAnchor": [17.5, 51],
                "popupAnchor": [0, -51],
                "className": "dot"
            }
        }
    }];';
    ?>
    <script>
    var coords = [-37.8231482, 144.9828481];
    L.mapbox.accessToken = 'pk.eyJ1IjoicmFuaXR1bml0ZXJyZW5lIiwiYSI6ImNqNTJnaWU1eTBlbTcyd25yZ3ltajJsMHYifQ.GG9AYBLMjI6RNVWJ6ynhAQ';
    var map = L.mapbox.map('map-one', 'jcnh74.la88enf6', {
        zoomControl: false,
        scrollWheelZoom: true
    }).setView(coords, 5);

    new L.Control.Zoom({
        position: 'topleft'
    }).addTo(map);
    // map.touchZoom.disable();
    // map.scrollWheelZoom.disable();
    // if (map.tap) map.tap.disable();



    //var coordsrev = coords.reverse()
    var myLayer = L.mapbox.featureLayer().addTo(map);

    
    var geoJSON = <?php echo $json ?>;

    // myLayer.on('layeradd', function(e) {
    //     var marker = e.layer,
    //         feature = marker.feature;

    //     marker.setIcon(L.icon(feature.properties.icon));
    // });

    myLayer.setGeoJSON(geoJSON);
 
    // var markers = [];
    // map.eachLayer(function(marker) {
    //     if (marker instanceof L.Marker) {
    //         markers.push(marker);
    //     }
    // });

    // myLayer.on('click', function(e) {
    //     var $el = jQuery(e.layer.feature.properties.description);
    //     var id = $el.attr('id');

    //     jQuery('.map-scroller').animate({
    //         scrollTop: jQuery('.map-scroller').find('#' + id).offset().top - 60
    //     }, 1);

    //     var pos = $el.position()
    //     jQuery(".map-scroller").scrollTop(pos);
    // });

    // function createCallback(i) {
    //     markers[i].openPopup();
    // }

    // jQuery(document).on('click','.map-scroller-item',function (e, index) {
    //   var $this = jQuery(this);
    //   //createCallback(e);
    //    markers[$this.index()].openPopup();
    //   //console.log(markers );
    //   map.setView([$this.data('lat'),$this.data('lon')], 15,{ 
    //     pan: { animate: true}, 
    //     zoom: { animate: true } 
    // });
    // });


    // jQuery('.map-scroller-item').each(function(i) {
    //     var $this = jQuery(this);

    //     var pos = $this.position();
    //     $this.scrollspy({
    //         min: pos.top - (jQuery('.map-scroller').height() / 2),
    //         max: pos.top - (jQuery('.map-scroller').height() / 2) + $this.height(),
    //         container: jQuery('.map-scroller'),
    //         onEnter: function(element, position) {
    //             createCallback(i);
    //             map.setView([$this.data('lat'), $this.data('lon')], 15, {
    //                 pan: {
    //                     animate: true
    //                 },
    //                 zoom: {
    //                     animate: true
    //                 }
    //             });
    //         },
    //         onLeave: function(element, position) {}
    //     });
    // });


    jQuery('.explore').on('click', function() {
        jQuery('.center-wrap').fadeOut();

        jQuery('.wrapArea').addClass('makeFull');

        jQuery('.wrapArea .map-scroller').css({
            'opacity': '1'
        });
    });
    jQuery('.close').on('click', function(argument) {
        jQuery('.center-wrap').fadeIn();
        jQuery('.wrapArea .map-scroller').css({
            'opacity': '0'
        });
        jQuery('.wrapArea').removeClass('makeFull');
    });
    </script>




<?php get_footer(); ?>
