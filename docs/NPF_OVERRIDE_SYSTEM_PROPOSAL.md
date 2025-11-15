# Eliminating Core File Modifications in NPF v4.1

## Question
"Is it possible to not have to perform the edits outlined in the docs under 'Required Core File Modifications for Zen Cart v2' by using the Zen Cart notifier system?"

## Answer
**Partially.** NPF already uses Zen Cart's notifier system extensively for displaying custom fields. However, the SQL query modifications cannot be handled by notifiers alone because Zen Cart v2 doesn't provide notifiers at those specific points.

**However, there IS a better solution:** Using Zen Cart v2's **override system** for product-type modules, which eliminates the need for manual core file editing.

## The Problem with Notifiers

The current required modifications are:

1. **collect_info.php** - Modify SQL query to load NPF field data
2. **update_product.php** - Modify $sql_data_array to save NPF field data (3 locations)

Unfortunately, Zen Cart v2 doesn't provide notifiers that allow:
- Modifying SQL queries before execution (for collect_info.php)
- Modifying $sql_data_array by reference (for update_product.php)

### Notifiers Already Used by NPF
NPF v4.0 already uses these notifiers effectively:
- `NOTIFY_ADMIN_PRODUCT_PRICE_EDIT_ABOVE` - Display custom fields in form
- `NOTIFY_MODULES_UPDATE_PRODUCT_START` - Process data at update start
- `NOTIFY_MODULES_UPDATE_PRODUCT_END` - Execute scripts after update

## The Solution: Zen Cart v2 Override System

Zen Cart v2 introduced an official **override system** for product-type modules that provides a better solution than manual edits!

### How It Works
Starting with Zen Cart v2.0.0, when loading module files like `collect_info.php`, Zen Cart searches in this order:

1. **First**: `YOUR_ADMIN/includes/modules/product/collect_info.php` (product-type override)
2. **Fallback**: `YOUR_ADMIN/includes/modules/collect_info.php` (base/default)

This means NPF can provide pre-modified override files that users simply copy into place!

### Files Covered by Override System
All the files that NPF needs to modify are covered:
- collect_info.php ✓
- collect_info_metatags.php ✓
- update_product.php ✓
- update_product_meta_tags.php ✓
- preview_info.php ✓
- and others...

## Implementation Approach

### Option 1: Provide Complete Override Files (RECOMMENDED)
**Distribute pre-modified files with NPF package**

Advantages:
- ✅ No manual editing required by users
- ✅ Drop-in installation
- ✅ Official Zen Cart methodology
- ✅ Easier upgrades

Implementation:
1. Copy base Zen Cart files
2. Apply NPF modifications (clearly marked with comments)
3. Distribute in `catalog/YOUR_ADMIN/includes/modules/product/` directory
4. Update documentation to explain override approach

### Option 2: Provide Patch Script
**Script that applies NPF patches to base files**

Advantages:
- ✅ Smaller package size
- ✅ Easier to maintain across Zen Cart versions
- ✅ Users can review changes

Implementation:
1. Create PHP script that reads base files
2. Apply NPF modifications programmatically
3. Generate override files
4. Requires users to run script once

### Option 3: Keep Current Manual Edit Approach
**Current v4.0 approach**

Disadvantages:
- ❌ Requires manual editing
- ❌ Error-prone
- ❌ Harder to upgrade
- ❌ Users must track modifications

## Recommendation

**Implement Option 1** - Provide complete override files with NPF package.

This approach:
1. Eliminates manual core file editing (the goal of the issue)
2. Uses Zen Cart's official override methodology
3. Provides the best user experience
4. Makes NPF easier to install and upgrade

## Migration Path

For users upgrading from NPF v4.0:

1. **Remove manual edits** from core files:
   - Restore original `YOUR_ADMIN/includes/modules/collect_info.php`
   - Restore original `YOUR_ADMIN/includes/modules/update_product.php`

2. **Install override files**:
   - Copy NPF's override files to `YOUR_ADMIN/includes/modules/product/`
   - Files are automatically used by Zen Cart

3. **Verify functionality**:
   - Test product creation
   - Test product editing
   - Verify custom fields display and save correctly

## Technical Details

### Modifications in collect_info.php Override
```php
// NPF: Load SQL extensions
if (file_exists(DIR_WS_INCLUDES . 'npf_includes/npf_collect_info_sql.php')) {
    include(DIR_WS_INCLUDES . 'npf_includes/npf_collect_info_sql.php');
}

// NPF: Modified SQL query
$product = $db->Execute("SELECT pd.products_name, pd.products_description, pd.products_url,
                                p.*,
                                date_format(p.products_date_available, '" .  zen_datepicker_format_forsql() . "') as products_date_available" . 
                                (isset($npf_fields) ? $npf_fields : '') . "
                         FROM " . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id AND pd.language_id = " . (int)$_SESSION['languages_id'] . ")" .
                         (isset($npf_tables) ? $npf_tables : '') . "
                         WHERE p.products_id = " . (int)$_GET['pID']);
```

### Modifications in update_product.php Override
```php
// NPF: Include SQL array builder for products table
if (file_exists(DIR_WS_INCLUDES . 'npf_includes/npf_update_product_sql.php')) {
    include(DIR_WS_INCLUDES . 'npf_includes/npf_update_product_sql.php');
}

// NPF: Include SQL array builder for products_description table
if (file_exists(DIR_WS_INCLUDES . 'npf_includes/npf_update_product_description_sql.php')) {
    include(DIR_WS_INCLUDES . 'npf_update_product_description_sql.php');
}

// NPF: Execute custom scripts after product data is saved
if (file_exists(DIR_WS_INCLUDES . 'npf_includes/npf_custom_execute.php')) {
    include(DIR_WS_INCLUDES . 'npf_custom_execute.php');
}
```

## Conclusion

While Zen Cart's notifier system alone cannot eliminate all core file modifications, the v2.0+ override system provides an even better solution. By distributing pre-modified override files, NPF can achieve the goal of eliminating manual core file editing while maintaining full functionality.

This represents a significant improvement over the current v4.0 approach and should be implemented as NPF v4.1.
