<?php 
/*
* The template for displaying the front page
*/
get_header(); 

global $pet_options;
?>
    
    <section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul>
                        <li><a href="http://localhost/uniterrene/pet/pampered-pets/"> Pampered Pets</a></li>
                        <li><a href="#"> Senior Pets Care</a></li>
                    </ul>
                </div>
               </div>
        </div>
    </section>
   
    <section id="banner">
        <div class="container banner banner1_bg">
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