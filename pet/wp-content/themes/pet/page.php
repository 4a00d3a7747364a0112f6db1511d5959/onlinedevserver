<?php

/*

* The template for inner pages

*/

get_header(); ?>

	<section id="jwelry_products">
        <div class="container jwelry" style="min-height: 400px;">
            
            <?php
                if(have_posts()){
                    while (have_posts()) { the_post();
                        the_content();
                    }
                }
            ?>
            
        </div>
    </section>

<?php get_footer(); ?>