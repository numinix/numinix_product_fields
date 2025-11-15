NUMINIX PRODUCT FIELDS - OVERRIDE FILES FOR ZEN CART v2
=========================================================

This directory contains override files that extend Zen Cart's base product 
editing modules to support Numinix Product Fields (NPF).

HOW ZEN CART v2 OVERRIDES WORK
-------------------------------
Starting with Zen Cart v2.0.0, the product-type-specific module files work 
as overrides. When Zen Cart needs to load a module file like "collect_info.php",
it first looks for:
    YOUR_ADMIN/includes/modules/product/collect_info.php
    
If not found, it loads the default:
    YOUR_ADMIN/includes/modules/collect_info.php

This means NO MANUAL EDITING of core files is required!

FILES IN THIS DIRECTORY
------------------------
The following override files are provided by NPF:

1. collect_info.php
   - Extends the product data loading SQL query to include NPF custom fields
   - Automatically loads NPF field definitions and table joins
   
2. update_product.php
   - Extends product save functionality to include NPF custom fields  
   - Handles both products table and products_description table NPF fields
   - Executes NPF custom scripts after product data is saved

INSTALLATION
------------
These files are automatically installed when you upload the NPF package.
They will be placed in:
    YOUR_ADMIN/includes/modules/product/

No additional action is required!

UPGRADING
---------
When upgrading NPF, these override files will be updated automatically.
When upgrading Zen Cart, you should:
1. Review the changelog for changes to collect_info.php and update_product.php
2. Compare NPF override files with new base files
3. Update NPF override files if necessary

ADVANTAGES OVER MANUAL EDITS
-----------------------------
✓ No editing of core Zen Cart files required
✓ Easier to upgrade Zen Cart (core files remain untouched)
✓ Easier to upgrade NPF (just replace override files)
✓ Cleaner separation between NPF and Zen Cart core
✓ Follows Zen Cart's official override methodology
✓ All NPF functionality in one package

TECHNICAL DETAILS
-----------------
These override files include the necessary NPF hooks at the following points:

collect_info.php:
  - Loads npf_collect_info_sql.php before SQL query
  - Appends $npf_fields and $npf_tables to SQL query

update_product.php:
  - Loads npf_update_product_sql.php after $sql_data_array creation
  - Loads npf_update_product_description_sql.php in products_description loop
  - Loads npf_custom_execute.php before final redirect

For more information, see the main NPF documentation at:
docs/Numinix Product Fields/readme.html
