<?php
	$head1='Casino';
    $head2='Bonus';
    $head3='Features';
    $head4='Rating';
    
    if(isset($casino_list_enabled_bonus[0])==False and $casino_list_custom_1!="") $head2=str_contains($casino_list_custom_1, 'g_') ? ucwords(str_replace('_', ' ', substr($casino_list_custom_1,2))) : ucwords(str_replace('_', ' ', $casino_list_custom_1));
	if(isset($casino_list_enabled_features[0])==False and $casino_list_custom_2!="") $head3=str_contains($casino_list_custom_2, 'g_') ? ucwords(str_replace('_', ' ', substr($casino_list_custom_2,2))) : ucwords(str_replace('_', ' ', $casino_list_custom_2));
	if(isset($casino_list_enabled_rating[0])==False and $casino_list_custom_3!="") $head4=str_contains($casino_list_custom_3, 'g_') ? ucwords(str_replace('_', ' ', substr($casino_list_custom_3,2))) : ucwords(str_replace('_', ' ', $casino_list_custom_3));
?>

<div class="lc__head d-d-md-n mb-20 py-15 px-20 br-t-20 fw-m tc-w bg-pv">
  <div class="row ai-c">
    <div class="col-thumb pr-8">#</div>
    <div class="col-casino px-8"><?php _e($head1, 'elegance'); ?></div>
    <div class="col-bonus px-8 pr-u-lg-18"><?php _e($head2, 'elegance'); ?></div>
    <div class="col-features px-u-lg-18 px-d-md-8"><?php _e($head3, 'elegance'); ?></div>
    <div class="col-rating px-u-lg-18 px-d-md-8"><?php _e($head4, 'elegance'); ?></div>
  </div>
</div>