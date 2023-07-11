<?php
use Classes\Casino\CustomPostType;
use Classes\Casino\CustomTaxonomy;
use Classes\Casino\CasinoCustomFields;

/**
 * Register post type and taxonomies
 */
if(class_exists(CustomPostType::class)){
    new CustomPostType('Casino','casino','dashicons-clipboard',false,true,array('thumbnail','title','editor'));
    new CustomTaxonomy('casino','Software','software',true,false);
    new CustomTaxonomy('casino','Deposits','deposits',true,false);
    new CustomTaxonomy('casino','Withdrawal','withdrawal',true,false);
    new CustomTaxonomy('casino','Language','language',true,false);
    new CustomTaxonomy('casino','Licence','licence',true,false);
    new CustomTaxonomy('casino','Currencies','currencies',true,false);
    new CustomTaxonomy('casino','Crypto','crypto',true,false);
    new CasinoCustomFields();
}

new Classes\Casino\ShortcodeGenerator();
