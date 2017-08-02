<?php
/*
* Template Name: Media Center Page Template
*/

get_header(); 
?>

<!-- inner banner -->
<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(<?php echo $church_options['blog_common_banner']['url']; ?>) no-repeat center center; background-size:cove;">
     <div class="overlay">
      <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php 
          $spanvalue = get_the_title();
          $words = 1;
          $words = $words-1;
        $arr = explode(' ',trim($spanvalue));
        $arrre = '';
        for($sb = 0; $sb <= count($arr); $sb++){
          $arrre .= $arr[$sb].' ';          
          if($words == $sb){ 
            $arrre .="<span>";
          }else{

          }
        }
        ?>
        <h3><?php echo $arrre; ?></span></h3>
        <?php endwhile; ?>

        <?php echo do_shortcode( '[breadcrumb]' ); ?>
      </div>
     </div>
    </div>
</section>

<section class="inner-div media_center" style="background:url(http://onlinedevserver.biz/dev/church/wp-content/uploads/2017/05/Video-Reel-Blue-780W.jpg) no-repeat center center; background-size:cover; background-attachment:fixed;">
  <div class="inner-overlay"></div>
	<div class="container">
	 	<div class="row">
          <div class="media_center-contener clearfix">
          
	 	 	<div class="col-lg-10 col-md-10 col-md-offset-1">
	 	 	 <div class="flowplayer-video-box clearfix">
				<div class="main-content">
						
						<!--invite friend-->
						<div class="row">
			            	<div class="col-md-12">
								<div class="row">
									<div class="col-sm-7 col-md-5 col-lg-7"></div>
									<div class="col-sm-3 col-md-4 col-lg-3">
										<div class="share-flw-video">
											<a class="share-video-btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i> Share this service</a>
											<!-- Modal -->
											<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLabel" style="display: block; text-align: center;">Invite your friend for a good cause</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body clearfix">
											        <?php echo do_shortcode('[contact-form-7 id="518" title="Invite a Friend"]'); ?>
											      </div>
											      <div class="modal-footer">
											        <p>Change the life of someone today, invite him/her to our church services</p>
											      </div>
											    </div>
											  </div>
											</div>
										</div>
									</div>
									<div class="col-sm-2 col-md-3 col-lg-2">
										<div class="social-video-share">
											<!-- AddToAny BEGIN -->
											<div>
											<a href="https://www.addtoany.com/add_to/facebook?linkurl=<?php the_field('featured_webm_video_link'); ?>&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/facebook.svg" width="32" height="32"></a>
											<a href="https://www.addtoany.com/add_to/twitter?linkurl=<?php the_field('featured_webm_video_link'); ?>&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/twitter.svg" width="32" height="32"></a>
											</div>
											<!-- AddToAny END -->
										</div>
									</div>
								</div>
			            	</div>
						</div>
		               <!--invite friend-->
					
				        <div class="flowplayer-left-section">
			               <span class="flowplayer-quality-heading">Video Quality</span>
			               <ul id="custom_res" >
				               <li><a data-quality="216p" href="javascript:void(0)" class="btnPlay"> <span> <i class="fa fa-play-circle-o"></i></span> 216p</a></li>
				               <li class="current"><a data-quality="360p" href="javascript:void(0)" class="btnPlay"><span><i class="fa fa-play-circle-o"></i></span> 360p</a></li>
				               <li><a data-quality="720p" href="javascript:void(0)" class="btnPlay"><span> <i class="fa fa-play-circle-o"></i></span> 720p</a></li>
				               <li><a data-quality="1080p" href="javascript:void(0)" class="btnPlay"><span> <i class="fa fa-play-circle-o"></i></span> 1080p</a></li>
			               </ul>			               
				        </div>
					    <div class="flowplayer-right-section">
				            <!-- <div class="flowplayer" data-swf="<?php //echo get_template_directory_uri(); ?>/js/flowplayer.swf" data-ratio="0.4167">
				                 <video id="my-video" class="video-js" controls>
				            	<source type="video/webm" src="https://cdn.flowplayer.org/202777/96435-crashingwavesonrocksduringsunset1R5f13lB.webm">
				                  <source type="video/mp4" src="https://cdn.flowplayer.org/202777/96435-crashingwavesonrocksduringsunset1R5f13lB.mp4">
				            	</video>                   
				            </div> -->

				            <video id="my-video" class="fp-engine" no-toggle controls>
								  <source src="<?php the_field('featured_webm_video_link'); ?>" type="video/webm">
								  Your browser does not support the video format.
							</video>
				         </div>

			        <script type="text/javascript">
					   jQuery(document).ready(function($){
					      $('.fp-engine').attr('id','video_id');
					      
					      var video = $('#video_id').find('source').attr('src');
					      //alert(video);
					      $('#custom_res li a').on('click',function(){ 
						  	$(this).parent().addClass('current').siblings().removeClass('current');        
					         $('#video_id').attr('autoplay',true);
					         var data_quality = $(this).attr('data-quality');         
					         var str = video; 
					               
					         if (str.indexOf("216p") >= 0){                  
					           var new_l = str.replace('216p', data_quality);
					           $('#video_id').attr('src', new_l);
					         }else if (str.indexOf("360p") >= 0){                  
					           var new_l = str.replace('-360p', '');
					           $('#video_id').attr('src', new_l);
					         }else if (str.indexOf("720p") >= 0){                  
					           var new_l = str.replace('720p', data_quality);
					           $('#video_id').attr('src', new_l);
					         }else if (str.indexOf("1080p") >= 0){                  
					           var new_l = str.replace('1080p', data_quality);
					           $('#video_id').attr('src', new_l);
					         }else{
					            //alert(data_quality);
					            if(data_quality == '360p'){
					               var new_l = str.replace('-360p.webm', '.webm');
					               $('#video_id').attr('src', new_l);
					            }else{
					               var new_l = str.replace('.webm', '-'+data_quality+'.webm');
					               $('#video_id').attr('src', new_l);
					            }            
					         }
					      });
					   });
					</script>

				</div>
			 </div>	
			</div>

			<div class="col-lg-10 col-md-10 col-md-offset-1">
             <div class="archived_videos-box">
              <div class="arcive-video-heding">
               <h3> archived videos </h3>
              </div>
            
			  <div class="video-box-media">
                          
				<?php
					$paged = 1;
					if ( get_query_var('paged') ) $paged = get_query_var('paged');
					if ( get_query_var('page') ) $paged = get_query_var('page');
					 
					query_posts( '&post_type=flowplayer5&paged=' . $paged );
				?>
				<!--video list-->
				    <table class="table">
					    <thead>
					   	  <tr>
					        <th><i class="fa fa-universal-access" aria-hidden="true"></i> Service Name </th>
					        <th><i class="fa fa-calendar" aria-hidden="true"></i> Posted</th>
					        <th>Play</th>
					      </tr>
					    </thead>
					    <tbody>
							<?php 
					          $video_args = array( 'post_type' => 'flowplayer5', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', 'paged' => $paged );
					          $video_query = new WP_Query( $video_args ); 

					          //print_r($video_query);

					          $i = 1;
 
					          while ( $video_query->have_posts() ) { $video_query->the_post();
					        ?>
					      <tr>
					        <td><?php the_title(); ?></td>
					        <td><?php echo get_the_date('jS F, Y'); ?></td>
					        <td>

							<a class="video-btn" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
							<!-- Modal -->
							<div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel" style="display: block;"><?php the_title(); ?></h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <video width="100%" height="340" controls>
									  <source src="<?php echo get_post_meta(get_the_ID(), 'fp5-mp4-video', true); ?>" type="video/mp4">
									  Your browser does not support the video format.
									</video>
							      </div>
							      <div class="modal-footer">
							        Posted on: <?php echo get_the_date('jS F, Y'); ?>
							        <!-- AddToAny BEGIN -->
									<div>
									<p>Share this service: </p>
									<a href="https://www.addtoany.com/add_to/facebook?linkurl=<?php echo get_post_meta(get_the_ID(), 'fp5-mp4-video', true); ?>&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/facebook.svg" width="32" height="32"></a>
									<a href="https://www.addtoany.com/add_to/twitter?linkurl=<?php echo get_post_meta(get_the_ID(), 'fp5-mp4-video', true); ?>&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/twitter.svg" width="32" height="32"></a>
									</div>
									<!-- AddToAny END -->
							      </div>
							    </div>
							  </div>
							</div>

					        </td>

					      </tr>
					      <?php $i++; }  wp_reset_postdata(); ?>

					    </tbody>
					  </table>
					  <!--video list-->
					  
			</div>
             
			  <div class="row">
			    <div class="col-md-12">
			     <div class="video-flowplayer-pagination">
				  <?php echo paginate(); ?>
                 </div>
               </div> 
              </div>
              
		    </div>
		  </div>
          </div>
		 </div> 

			

		
    </div>
</section>

<?php get_footer(); ?>