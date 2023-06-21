<?php    
  if (!isset($pInfo->products_weight_type)) $pInfo->products_weight_type = TEXT_PRODUCT_WEIGHT_UNIT;
  switch ($pInfo->products_weight_type) {
    case 'kgs': $in_weight_type = true; $out_weight_type = false; break;
    case 'lbs':
    default: $in_weight_type = false; $out_weight_type = true;
  }
  if (!isset($pInfo->products_dim_type)) $pInfo->products_dim_type = TEXT_PRODUCT_DIMENSION_UNIT;
  switch ($pInfo->products_dim_type) {
    case 'cm': $in_dim_type = true; $out_dim_type = false; break;
    case 'in':
    default: $in_dim_type = false; $out_dim_type = true;
  }