<?php
/**
 * Template Name: vip Page
 */
get_header();
?>

<section id="vip-member-section" class="vip-member-section-div">
 <div class="container">
  <div class="vip-member-box">
    <div class="vip-member-box-top">
     <h3> <?php echo get_option('webq_vip_lounge_head');?> </h3>
     <div class="about-box-divider"><span> </span></div>
    </div> 
    <div class="vip-member-box-content">
     <?php echo get_option('webq_vip_lounge');?>
    </div>
  </div>
 </div>
</section>

<section id="vip-member-acrodian" class="vip-member-acrodian-div">

   <div class="play-boy-icon"> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/paly-boy-icon.png" /> </div>
    <div class="vip-member-acrodian-box">
  
     <ul class="accordion">
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_ben_head');?>
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                <?php echo get_option('webq_vip_ben');?>
                </div>
             </div> 
            </div> 
        </li>
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_lux_head');?>
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <?php echo get_option('webq_vip_lux');?>
              </div>
             </div> 
            </div> 
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_car_head');?>
            </div>
             <div class="accordion-panel">
              <div class="container">
               <div class="accordion-pane-box">
                <?php echo get_option('webq_vip_car');?>
                </div>
               </div> 
             </div>
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_youth_head');?>
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <?php echo get_option('webq_vip_youth');?>
               </div>
              </div> 
            </div> 
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_jet_head');?>
            </div> 
            <div class="accordion-panel">
             <?php echo get_option('webq_vip_jet');?>
            </div> 
         </li>
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_hotel_head');?>
            </div>
            <div class="accordion-panel"> 
              <?php echo get_option('webq_vip_hotel');?>
            </div>
          </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_safari_head');?>
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <?php echo get_option('webq_vip_safari');?>
              </div>
             </div>  
            </div>
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_candel_head');?>
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
            <?php echo get_option('webq_vip_candel');?>
              </div>
             </div> 
            </div>
        </li>
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_private_head');?>
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                <?php echo get_option('webq_vip_private');?>
               </div>
              </div> 
            </div>
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_post_head');?> 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <?php echo get_option('webq_vip_post');?>
              </div>
             </div> 
            </div>
        </li>
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_tour_head');?>
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
            <?php echo get_option('webq_vip_tour');?>
              </div>
             </div>  
            </div>
        </li>
          <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_prf_head');?>
            </div> 
            <div class="accordion-panel">
             <?php echo get_option('webq_vip_prf');?>
             </div>
         </li>
          <li>
            <div class="accordion-tab">
           <?php echo get_option('webq_vip_sit_head');?>
            </div> 
            <div class="accordion-panel">
             <?php echo get_option('webq_vip_sit');?>
            </div>
        </li>
          <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_spcl_head');?>
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
              <?php echo get_option('webq_vip_spcl');?>
              </div>
             </div>  
            </div>
          </li>
    </ul> <!-- / accordion -->
    
   </div>
   <div class="play-boy-icon"> <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/paly-boy-icon.png" /> </div>
   

 
</section>

<section id="vip-packeges" class="vip-packeges-div">
  <div class="container">
    <div class="vip-packeges-box">
      <h3> <?php echo get_option('webq_vip_values_head');?> </h3>
     <?php echo get_option('webq_vip_values');?>
   </div>    
  </div>
  
    <div class="vip-packeges-details">
       <ul class="accordion">
        <li>
         <div class="accordion-tab"> All Lavish Mate VIP Plans </div> 
         <div class="accordion-panel">
             <div class="container">
              <div class="vip-packeges-details-box">
                <ul>
                 <li> 
                  <h3> $150 Lavish </h3>
                  <div class="vip-packeges-details-top">
                   <ul>
                    <li> FULL ACCESS to all models' hidden backstage areas, including their uncovered images and video content. </li>
                    <li> Priority for bookings over non-members </li>
                    <li> ADVANCE notice of new models </li>
                   </ul>
                  </div>
                  <div class="packeg-apply-btn-div">
                    <div class="packeg-apply-btn">
                     <a href="<?php echo get_home_url(); ?>/vip-form?plnname=lavishpln"> Apply Now </a>
                    </div>
                  </div>
                </li>
                 <li> 
                  <h3> $100,000 Silver </h3>
                  <div class="vip-packeges-details-top">
                   <ul>
                    <h4> << All regular benefits plus: </h4>
                    <li> Unlimited* dates for 3 months </li>
                    <li> Priority over regular members </li>
                    <li> Personal 24/7 VIP phone number </li>
                    <li> 1 private helicopter flight* </li>
                    <li> 1 luxury yacht charter* </li>
                   </ul>
                   <p> If you're a regular high end caller, you know a handful of private flights & upscale model bookings, hotels, dinners and cars can run $150k over the 90 days. For $100k you enjoy that and much more, hassle-free! </p>
                   <p> *Conditions apply </p>
                  </div>
                  <div class="packeg-apply-btn-div">
                    <div class="packeg-apply-btn">
                     <a href="<?php echo get_home_url(); ?>/vip-form?plnname=sliverpln"> Apply Now </a>
                    </div>
                  </div>
                </li>
                 <li> 
                  <h3> $250,000 Gold </h3>
                  <div class="vip-packeges-details-top">
                   <ul>
                    <h4> << All regular benefits plus: </h4>
                    <li> Unlimited* dates for 6 months </li>
                    <li> Priority over regular members </li>
                    <li> 1 private helicopter flight to local private island* </li>
                    <li> l uxury yacht charter* </li>
                    <li> 1 night on our private island </li>
                    <li> 1 month Chauffeured luxury car for each date </li>
                    <li> 1 month Luxury hotel accommodation for dates </li>
                   </ul>
                   <p> If you're a frequent high end caller, just a handful of private flights and a few travel bookings with diamond models through the year can equal over $300k. For $250k you enjoy all that and more, hassle-free! No more transfer issues, cash flow issues or transport issues. No expense spared. </p>
                   <p> *Conditions apply </p>
                  </div>
                  <div class="packeg-apply-btn-div">
                    <div class="packeg-apply-btn">
                     <a href="<?php echo get_home_url(); ?>/vip-form?plnname=goldpln"> Apply Now </a>
                    </div>
                  </div>
                </li>
                 <li> 
                  <h3> $500,000 Platinum </h3>
                  <div class="vip-packeges-details-top">
                   <ul>
                    <h4> << All regular benefits plus: </h4>
                    <li> Unlimited* dates for 12 months </li>
                    <li> Priority over regular members </li>
                    <li> Personal 24/7 VIP phone number </li>
                    <li> 1 private helicopter flight to local private island* </li>
                    <li> 2 domestic private jet flights* </li>
                    <li> 1 luxury yacht charter* </li>
                    <li> 2 nights on our private island </li>
                    <li> 6 months Chauffeured luxury car for each date </li>
                    <li> 6 months Luxury hotel accommodation for dates </li>
                   </ul>
                   <p> If you're a regular high end caller, you know a handful of private flights & upscale model bookings, hotels, dinners and cars can run $600k-$800k over the year. For $500k you enjoy that and much more, hassle-free! </p>
                   <p> *Conditions apply </p>
                  </div>
                  <div class="packeg-apply-btn-div">
                    <div class="packeg-apply-btn">
                     <a href="<?php echo get_home_url(); ?>/vip-form?plnname=platinumpln"> Apply Now </a>
                    </div>
                  </div>
                </li>
                 <li> 
                  <h3> $1,000,000 Black </h3>
                  <div class="vip-packeges-details-top">
                   <ul>
                    <h4> << All regular benefits plus: </h4>
                    <li> Unlimited* dates for 12 months </li>
                    <li> Absolute priority booking </li>
                    <li> Personal 24/7 VIP phone number </li>
                    <li> 2 private helicopter flights to local private island* </li>
                    <li> 4 domestic private jet flights* </li>
                    <li> 2 luxury yacht charters* </li>
                    <li> 4 nights on our private island </li>
                    <li> Chauffeured luxury car for each date </li>
                    <li> Luxury hotel accommodation for dates </li>
                   </ul>
                   <p> If you're a frequent high end caller, just a handful of private flights and a few travel bookings with diamond models through the year can equal over $2mill to $3mill. For $1mill you enjoy all that and more, hassle-free! No more transfer issues, cash flow issues or transport issues. No expense spared. </p>
                   <p> *Conditions apply </p>
                  </div>
                  <div class="packeg-apply-btn-div">
                    <div class="packeg-apply-btn">
                     <a href="<?php echo get_home_url(); ?>/vip-form?plnname=blackpln"> Apply Now </a>
                    </div>
                  </div>
                </li>
               </ul>
              </div>
             </div>  
            </div>
        </li>
       </ul>      
    </div>
  
</section>

<section id="vip-luxury-acrodian" class="vip-luxury-acrodian-div">
    <div class="container">
     <div class="vip-luxury-acrodian-heading">
      <h3> VIP Luxury packages additional details </h3>
      <p> As an elite agent Lavish Mate® is pleased to offer you a memorable and truly entertaining experience locally or internationally. Once you’ve booked a fantasy experience with us you will never want to take a “regular” vacation again! Our exclusive concierge service will ensure complete relaxation and a vacation that you will not soon forget. </p>
      <p> Lavish Mate® clients are busy; they lead pressured lifestyles and are usually responsible for the wellbeing and livelihood of lots of other people. Allow us to turn the tables and take care of you for a change. Rely on our exclusive travel and concierge service to revive and rejuvenate you. If you need some motivation or some fresh ideas, we’ve given you a few below. We are also proud to offer a fully personalized and customized service with your name on it, so please get in touch and we’ll make sure you are treated just right! </p>
     </div>
    </div>
    <div class="vip-member-acrodian-box">
  
     <ul class="accordion">
        
        <li>
            <div class="accordion-tab">
            <?php echo get_option('webq_vip_gf_head');?> 
            </div>
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <?php echo get_option('webq_vip_gf_head');?> 
               </div>
              </div>   
            </div> 
        </li>
        <li>
            <div class="accordion-tab">
             <?php echo get_option('webq_vip_booking_head');?> 
            </div>
             <div class="accordion-panel">
              <div class="container">
               <div class="accordion-pane-box">
               <?php echo get_option('webq_vip_booking');?> 
               </div>
              </div>  
             </div>
        </li>
         <li>
            <div class="accordion-tab">
              <?php echo get_option('webq_vip_agn_head');?> 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
                 <h4> What Sets Our Agency Apart </h4>
                 <p> None of these scenarios are likely to happen when you work through Lavish Mate®. We follow an intensive application and interview process. All of our companions sign NDAs and work agreements so we can extend our 100% guarantee to our clients. It is also important to note that the companion you book is the companion you will meet on your date. In the unlikely event that there is a difference in personalities, we will provide you with a different companion without question. </p>
                 <p> Lavish Mate® makes the booking process quick and easy for our clients. All of our models are attractive and intelligent. They are successful and ambitious. And, they enjoy meeting up for no-strings attached dates where their fantasies can be indulged. Once she is paired with someone like you, natural chemistry will take its course. Are you ready? </p>
                 <p> Please get in touch with us and we will talk you through choosing the ideal companion. Make a booking with one of our elite models and rediscover your inner passions. </p>
                 <p> Lavish Mate® has crafted our dating experiences to work, because we know that all these other avenues are a waste of your time. Our companions have to meet our eligibility criteria and we screen all applicants thoroughly to ensure they comply with our standards.  </p>
               </div>
              </div>  
            </div> 
        </li>
         <li>
            <div class="accordion-tab">
             Our Excellence and Superiority 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <p>Our agency and the model companions alike provide a prestigious, sparkling experience, during which our secret gentlemen can be pampered and appreciated. With our attention to detail and perfectionist standards, we are confident that those who appreciate the same high standards will understand. We are the perfect company for these high-achievers and successful industry stars to meet their match. Lavish Mate® is available to assess your every query and tailor your appointment perfectly to you. Whether coordinating meetings with models for social dates and weekends, or making travel arrangements, when you are a client of Lavish Mate®, we are here as your personal service agency, to make your time with us as pleasant and stress-free as possible.</p>
               </div>
              </div> 
            </div> 
        </li>
         <li>
            <div class="accordion-tab">
              Our Compelling Reputation
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <p>First and foremost, we guarantee 100% confidentiality and privacy forever. All our staff sign non-disclosure legal forms, and we give our word of honor to NEVER disclose the details of our clients, ever. What common behavior, to stoop as low as to violate the trust of one's clientele, for the sake of fame or fortune! Rest assured the Lavish Mate® staff and management will never, ever display such appalling, spineless conduct. We help create special experiences for special people - no commitments or nasty consequences.</p>
              </div>
             </div> 
            </div>
        </li>
          <li>
            <div class="accordion-tab">
             Our Discretion and Privacy 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <p>Privacy and discretion is of paramount importance to us. We promise never to disclose our companions’ personal details or those of our clients, and it’s this promise that has enabled us to develop our reputation around the globe. What common behavior, to stoop as low as to violate the trust of one's clientele, for the sake of fame or fortune! Our interest lies in creating mutually beneficial relationships, and putting people with needs in contact with one another. We help create special experiences for special people - no commitments or nasty consequences.</p>
              </div>
             </div> 
            </div>
        </li>
          <li>
            <div class="accordion-tab">
             Our luxury standing 
            </div> 
            <div class="accordion-panel"> 
             <div class="container">
              <div class="accordion-pane-box">
                <h4> Premium customer service </h4>
                <p>Over our years in business we have grown from strength to strength and eclipsed our competition. Each client receives professional and highly personalized service. We stand by our brand promise to protect our clients’ and companions’ confidentiality.</p>
                <p> We treat all of our clients like royalty, which says a lot because we actually have royalty and international celebrities on our books. Our focus lies in delivering the complete package: brains, beauty and confidence. </p>
                <p> The majority of our business is return business with the rest of our clientele reaching us because of our sterling reputation. This is a clear indicator of the levels of service we extend and our willingness to go the extra mile for our clients. We’ve noticed several of our brand assets have been copied by competitors; a clear sign of the esteem we hold within our industry. </p>
              </div>
             </div>  
            </div>
        </li>
         <li>
            <div class="accordion-tab">
              Life is short. Have some pleasure® 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
                 <h4> Treat yourself; you deserve it </h4>
                 <p>With so many hours spent working tirelessly around the clock, it’s probably high time that you started to enjoy yourself. And Lavish Mate® has the right formula to help you do just that. Whether for an exclusive black tie function or relaxed companionship in an intimate restaurant, our international female escorts are the perfect way to pass your time. Take a time out to spend a few hours in the company of an attractive and attentive companion who has eyes only for you. You deserve a break in the presence of someone who wants to pamper and make you feel special..</p>
                </div>
               </div>             
             </div>
        </li>
         <li>
            <div class="accordion-tab">
             Our Luxurious and Sophistication 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <p>We know how great our companions really are so we are willing to offer all clients a 100% guarantee on their date bookings. If you are less than impressed by the model who meets you, we will replace her at no additional cost to you. We are willing to do this on good faith because we are so confident in the caliber of model we employ. Our priority is to ensure a mutually enjoyable experience, so our open offer of good faith is to ensure our clients that there will never be any disappointments.</p>
              </div>
             </div>  
            </div>
        </li>
         <li>
            <div class="accordion-tab">
             Our Internationally Recognized, Globally Discreet 
            </div> 
            <div class="accordion-panel">
             <div class="container">
              <div class="accordion-pane-box">
               <p>Our extraordinary girlfriends and female companions are available to travel internationally throughout the world.  Our frequent calls from all over the globe have surprised even us, as to how far the word of our reputation has reached. Most of our models are Caucasian, European and Latina (Western-based) individuals, but all the companions are experienced travelers and will willingly accompany you to any five star location in the world (schedule permitting). Whether in the USA, Europe, Australia, Asia, the Middle East, Russia, or South America - a Lavish Mate courtesan will make your experience remarkable, with enduring memories.</p>
             <p>Rest assured that discretion comes under this heading also. You can travel freely with the Lavish Mate companions in complete discretion, as our models do not show their faces online, except in the exclusive VIP Member Section. The Members area is only available to current clients, by invitation only, for absolute confidentiality. You'll never be seen in public with a known internet model. </p>
             <h4> An Authentic Experience </h4>
             <p> Experienced as we are, Lavish Mate® is in a unique position to introduce you to the companion who makes you tick. Our match-making experience and success is unsurpassed but you have our word, that if you are anything less than impressed, we will rectify the situation immediately. Humans are not an exact science, and should there be an unforeseen personality clash, we will remedy it beautifully, with minimal fuss or discomfort. Our photographs are taken by our in-house photographer and accurately represent the models who work for us. </p>
             <p> Our extraordinary female companions are available to travel internationally throughout the world.  Our frequent calls from all over the globe have surprised even us, as to how far the word of our reputation has reached. </p>
             <p> In line with our objective of providing companions who appeal to a global audience, the majority of our companions are Caucasian, Latina and European. This being said, they are all avid travelers and are ready to accompany you anywhere in the world. No matter where you decide to jet off to, you will enjoy a magical experience in the company of a seasoned and gracious companion. </p>
             <p> Travel also carries our guarantee of discretion, and you can feel safe in the knowledge that your privacy will be protected wherever you go. Remember that the models’ faces can only be seen in the VIP Lounge and are not made available online to the general public. It is imperative to Lavish Mate® that our models are not active on any other sites, so there is no chance of anyone recognizing them. </p>
             <p> Please take note that our guarantee is exclusive of travel and transport fees. If you find a lack of compatibility within the first 10 minutes of your date you are required to contact us immediately and notify us that you would like to meet somebody else. If you cancel your date for any other reason, a cancelation fee will be levied to your account. In the event that you have had physical contact with the companion or she has undressed the guarantee is nullified. A guarantee may be utilized only once per appointment. Please be advised that Lavish Mate® is adept at matching high caliber companions to successful gentlemen and if the second companion sent is not suitable we may politely recommend you consider working with another agency. </p>
             <p> We are pleased to offer an exclusive companion service that exceeds your expectations. </p>
             <p> Browse our companion portfolio. </p>
            </div>
           </div>  
          </div>
        </li>
 
    </ul> <!-- / accordion -->
    
   </div>
 
</section>

<section id="vip-copyright" class="vip-copyright-div">
  <div class="container">
   <div class="vip-copy-right-img"> 
    <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/lavish-copy-right.png" />
   </div>
   <div class="vip-teax-chear-img"> 
    <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/vip-teax-chear.png" />
   </div>
   <div class="vip-copyright-text">
    <h3> Looking for Beautiful Companion Dates? </h3>
    <p> We are delighted to provide you with the most beautiful women, and the finest girlfriend experience, at our leading high class escort service. 
Our elite companions will make your dinner date, social occasion or vacation an unforgettable memory. </p>
   </div>

   
  </div>
   <div class="vip-copy-text-accordion">
    <!--<div class="about-box-divider vip-bottom-divider-top"><span> </span></div>-->
     <ul class="accordion">     
         <li>
            <div class="accordion-tab">
             Copyright 
            </div>
            <div class="accordion-panel">
             <div class="container">
               <div class="accordion-pane-box">
                 <p>All contents of our web sites (including but not limited to: Chihuahua head symbol, logo, texts, graphics, audio, video and layout) are exclusive copyright of Lavish Mate®. Our web pages or elements of our web pages are protected by copyright law and law of unfair competition and may not by copied, distributed or modified without our written consent. It is illegal and punishable by criminal law to copy, distribute or modify our copyrighted material without our prior consent. Lavish Mate® will pursue all legal remedies against infringements of our rights.
Lavish Mate® is a registered trademark in the United States, Canada and numerous other countries. This is also proof of the recognized expertise of Lavish Mate® which has emerged as a modern and globally operating elite escort agency over the years. In case of violation of our registered trademark Lavish Mate® we will initiate civil litigation for damages and will seek criminal prosecution by local law enforcement authorities.</p>
                </div>
             </div> 
            </div> 
        </li>
      </ul> 
    <!--<div class="about-box-divider"><span> </span></div>-->
   </div>
   
   <div class="back-to-ladies-btn">
    <a href="#"> Back to The Ladies </a>
   </div>
  
</section>


<div class="vip-footer">
 <?php get_footer();?>
</div> 
