<?php print_r(get_post_meta(get_the_ID(), 'prop_habitacioness', true)); ?>
<style>
    ul.general-list{
        margin: 0;
        padding: 0;
    }
    ul.general-list li{
        list-style-type: none;
        margin: 10px 0;
    }
    ul.general-list li img{
        margin-right: 10px;
    }
    ul.general-list li h3{
        font-family: "Open Sans", Sans-serif;
        font-size: 1.4em;
    }
</style>
<ul class="general-list">
    <?php //ACF Version ?>
    <?php if( get_field('prop_habitaciones', get_the_ID()) ){ ?>
    <li> <h3 style="margin: 0;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/01/grupo-orba-logotipo.png" style="width: 32px; height: 32px;"> <?php echo get_field('prop_habitaciones', get_the_ID()); ?> Habitaciones </h3> </li>
    <?php } ?>

    <?php if( get_field('prop_banos', get_the_ID()) ){ ?>
    <li> <h3 style="margin: 0;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/01/grupo-orba-logotipo.png" style="width: 32px; height: 32px;"> <?php echo get_field('prop_banos', get_the_ID()); ?> Baños </h3> </li>
    <?php } ?>

    <?php if( get_field('prop_estacionamiento', get_the_ID()) ){ ?>
    <li> <h3 style="margin: 0;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/01/grupo-orba-logotipo.png" style="width: 32px; height: 32px;"> <?php echo get_field('prop_estacionamiento', get_the_ID()); ?> Cajones para estacionamiento </h3> </li>
    <?php } ?>

    <?php if( get_field('prop_metros_cuadrados', get_the_ID()) ){ ?>
    <li> <h3 style="margin: 0;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/01/grupo-orba-logotipo.png" style="width: 32px; height: 32px;"> <?php echo get_field('prop_metros_cuadrados', get_the_ID()); ?> Metros Cuadrados </h3> </li>
    <?php } ?>

    <?php if( get_field('prop_metros_de_terreno', get_the_ID()) ){ ?>
    <li> <h3 style="margin: 0;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/01/grupo-orba-logotipo.png" style="width: 32px; height: 32px;"> <?php echo get_field('prop_metros_de_terreno', get_the_ID()); ?> Metros de terreno </h3> </li>
    <?php } ?>
</ul>