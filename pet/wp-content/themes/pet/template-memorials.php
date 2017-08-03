<?php
/*
* Template Name: Memorials template
*/

get_header(); 

global $pet_options;
?>

    <section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul>
                        <li><a href="<?php echo site_url('/').$pet_options['binkys-pampered-pets-link']; ?>"> Pampered Pets</a></li>
                        <li><a href="<?php echo site_url('/').$pet_options['binkys-senior-pet-care-link']; ?>"> Senior Pet Care</a></li>
                    </ul>
                </div>
               </div>
        </div>
    </section>
   
    <section id="banner">
        <div class="container banner banner1_bg_sb">
            <img src="<?php echo $pet_options['cat_memorial_banner']['url']; ?>">
            <div class="baner_text">
                <h1><?php echo $pet_options['cat_memorial']; ?></h1>
            </div>
        </div>
    </section>

    <section id="jwelry_products">
        <div class="container jwelry">
        
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <?php the_content(); ?> 
            <?php endwhile; endif; ?>

        </div>
    </section>

<?php get_footer(); ?>