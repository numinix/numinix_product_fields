<?php

function dirList($directory)
{
    // create an array to hold directory list
    $results = [];

    if (is_dir($directory)) {
        // create a handler for the directory
        if ($handler = opendir($directory)) {
            // keep going until all files in directory have been read
            while ($file = readdir($handler)) {
                // if $file isn't this directory or its parent,
                // add it to the results array
                if ($file !== '.' && $file !== '..') {
                    $results[] = $file;
                }
            }
            asort($results);
            // tidy up: close the handler
            closedir($handler);
        }
    }

    return $results;
}


function zen_get_field_from_table_products_description($product_id, $language_id, $field_name)
{
    global $db;
    $field_name = zen_db_input($field_name);
    $product = $db->Execute(
        "SELECT `" . $field_name . "` FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = " . (int)$product_id . " AND language_id = " . (int)$language_id
    );
    return $product->fields[$field_name];
}

function npf_add_prebuilt_fields($field)
{

    $lang_definitions_file = 'languages/english/npf_definitions/' . $field . '.php';

    $array_of_files = [
        $lang_definitions_file,
        'functions/extra_functions/' . $field . '.php',
        'npf_includes/npf_custom_execute/' . $field . '.php',
        'npf_includes/npf_description_sql_array/' . $field . '.php',
        'npf_includes/npf_modules/' . $field . '.php',
        'npf_includes/npf_process/' . $field . '.php',
        'npf_includes/npf_sql/' . $field . '.php',
        'npf_includes/npf_sql_array/' . $field . '.php',
        'npf_includes/npf_templates/' . $field . '.php',
        'npf_includes/npf_preview/' . $field . '.php',
        'npf_includes/npf_preview_info/' . $field . '.php',
    ];
    $npf_copy_failed_count = 0;
    foreach ($array_of_files as $possible_file) {
        if (!npf_copy_file($field, $possible_file)) {
            $npf_copy_failed_count++;
        }
    }
    if ($npf_copy_failed_count == count($array_of_files)) { // if none of the files gets copied over, something is wrong for sure
        return false;
    }
    return true;
}

function npf_copy_file($field, $folder)
{
    if (file_exists(DIR_FS_ADMIN . NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder)) {
        $contents = file_get_contents(DIR_FS_ADMIN . NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder);
        $copy_file_result = file_put_contents(DIR_FS_ADMIN . DIR_WS_INCLUDES . $folder, $contents);
        if ($copy_file_result == 0 || $copy_file_result == false) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function npf_sql_patch($string)
{
    global $sniffer, $db;
    $string = str_replace("`", "", $string);
    $string = str_replace(" products ", " " . DB_PREFIX . "products ", $string);
    $string = str_replace(" product_type_layout ", " " . DB_PREFIX . "product_type_layout ", $string);
    $string = str_replace(" products_description ", " " . DB_PREFIX . "products_description ", $string);
    $query_array = explode(';', $string);
    foreach ($query_array as $query) {
        if (strlen($query) > 5) {
            $db->Execute($query . ';');
        }
    }
}

if (!function_exists('npf_field_value')) {

    function npf_field_value($id, $field)
    {
        global $db;
        $product = $db->Execute("SELECT * FROM " . TABLE_PRODUCTS . " WHERE products_id=" . (int) $id . " LIMIT 1");
        return $product->fields[$field];
    }

}

function zen_npf_file($npf_file)
{
    if (!empty($npf_file) && (file_exists(DIR_FS_CATALOG . $npf_file))) {
        $npf_file = '<a href="' . HTTPS_CATALOG_SERVER . DIR_WS_HTTPS_CATALOG . $npf_file . '" target="_blank" rel="noopener noreferrer">' . $npf_file . '</a>';
    } else {
        $npf_file = "FILE IS MISSING";
    }

    return $npf_file;
}

function zen_npf_video($npf_video)
{
    if (empty($npf_video) || !is_string($npf_video)) {
        return '';
    }

    $npf_video = preg_replace('#\.\.[/\\\\]#', '', $npf_video);
    $npf_video = ltrim($npf_video, '/\\');

    if (!is_file(DIR_FS_CATALOG . $npf_video)) {
        return '';
    }

    $mime_map = defined('NPF_VIDEO_MIME_MAP') ? unserialize(NPF_VIDEO_MIME_MAP) : [
        'mp4'  => 'video/mp4',
        'webm' => 'video/webm',
        'ogg'  => 'video/ogg',
        'mov'  => 'video/quicktime',
        'avi'  => 'video/x-msvideo',
        'mkv'  => 'video/x-matroska',
        'm4v'  => 'video/x-m4v',
        'flv'  => 'video/x-flv',
    ];
    $ext = strtolower(pathinfo($npf_video, PATHINFO_EXTENSION));
    $type_attr = isset($mime_map[$ext]) ? ' type="' . $mime_map[$ext] . '"' : '';
    $video_url = HTTPS_CATALOG_SERVER . DIR_WS_HTTPS_CATALOG . $npf_video;

    return '<video controls style="max-width:100%;max-height:240px;" preload="metadata">'
         . '<source src="' . htmlspecialchars($video_url, ENT_QUOTES, 'UTF-8') . '"' . $type_attr . '>'
         . 'Your browser does not support the video tag.'
         . '</video>';
}

function npf_normalize_field_name($field_name)
{
    $field = strtolower(trim((string)$field_name));
    $field = preg_replace('/[^a-z0-9_]+/', '_', $field);
    $field = preg_replace('/_+/', '_', $field);
    return trim($field, '_');
}

function npf_validate_custom_field_name($field)
{
    if ($field === '') {
        return 'Field name is required.';
    }
    if (!preg_match('/^[a-z][a-z0-9_]*$/', $field)) {
        return 'Field name must start with a letter and contain only letters, numbers, and underscores.';
    }
    if (strlen($field) > 64) {
        return 'Field name must be 64 characters or fewer.';
    }

    if (in_array($field, ['action', 'master_categories_id', 'products_id', 'products_image', 'products_model', 'products_price', 'products_quantity', 'products_status', 'type'], true)) {
        return 'Field name "' . $field . '" is reserved by Zen Cart.';
    }

    return '';
}

function npf_ensure_writable_directories(array $directories)
{
    foreach ($directories as $directory) {
        if (!is_dir($directory)) {
            return 'Required directory does not exist: ' . $directory;
        }
        if (!is_writable($directory)) {
            return 'Required directory is not writable: ' . $directory;
        }
    }

    return '';
}

function npf_write_generated_file($filename, $contents)
{
    return file_put_contents($filename, $contents, LOCK_EX) !== false;
}

function add_custom_field($field_name, $type, $length = '300')
{
    global $db, $messageStack;
    $field = npf_normalize_field_name($field_name);
    $nice_field_name = ucwords(strtolower(str_replace('_', ' ', $field)));
    global $sniffer;
    $validation_error = npf_validate_custom_field_name($field);
    if ($validation_error !== '') {
        $messageStack->add('ERROR!! ' . $validation_error, 'error');
        return;
    }

    $valid_types = ['text', 'checkbox', 'file', 'video'];
    if (!in_array($type, $valid_types, true)) {
        $messageStack->add('ERROR!! Invalid NPF field type selected.', 'error');
        return;
    }

    $length = (int)$length;
    if ($length <= 0) {
        $length = 300;
    }
    if ($length > 65535) {
        $messageStack->add('ERROR!! Field length is too large.', 'error');
        return;
    }

    if ($sniffer->field_exists(TABLE_PRODUCTS, $field)) {
        $messageStack->add('ERROR!! Product field ' . $field . ' already exists', 'caution');
        return;
    }

    $is_upload = in_array($type, ['file', 'video'], true);
    $required_directories = [
        NPF_DEFINITIONS_FOLDER,
        NPF_INCLUDES_SQL_FOLDER,
        NPF_INCLUDES_SQL_ARRAY_FOLDER,
        NPF_INCLUDES_TEMPLATES_FOLDER,
    ];
    if ($is_upload) {
        $required_directories = array_merge($required_directories, [
            NPF_INCLUDES_PROCESSING_FOLDER,
            NPF_INCLUDES_PREVIEW_FOLDER,
            NPF_INCLUDES_PREVIEW_INFO_FOLDER,
            NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER,
        ]);
    }
    if ($type === 'video') {
        $catalog_display_dir = DIR_FS_CATALOG . 'includes/modules/npf_catalog_display/';
        if (!is_dir($catalog_display_dir) && !mkdir($catalog_display_dir, 0755, true)) {
            $messageStack->add('ERROR!! Unable to create catalog display directory: ' . $catalog_display_dir, 'error');
            return;
        }
        $required_directories[] = $catalog_display_dir;
    }

    $writable_error = npf_ensure_writable_directories($required_directories);
    if ($writable_error !== '') {
        $messageStack->add('ERROR!! ' . $writable_error, 'error');
        return;
    }

    $lang_defines = strtoupper($field);
    switch ($type) {
        // general file upload field. show URL instead of image
        case "file":
            $sql_type = "varchar(" . $length . ") DEFAULT NULL";
            $string_input_field = "<hr>
<h2><?php echo TEXT_" . $lang_defines . "; ?></h2>
<?php
if (!empty(\$pInfo->" . $field . ")) { ?>
    <div class=\"form-group\">
        <div class=\"col-sm-offset-3 col-sm-9 col-md-6\">
            <?php echo zen_npf_file(\$pInfo->" . $field . "); ?>
        </div>
    </div>
    <div class=\"form-group\">
        <p class=\"col-sm-3 control-label\"><?php echo \"Remove File? Note: Removes file from product (file is NOT deleted/removed from server):\"; ?></p>
        <div class=\"col-sm-9 col-md-6\">
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '0', true) . TABLE_HEADING_NO; ?></label>
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '1', false) . TABLE_HEADING_YES; ?></label>
        </div>
    </div>
<?php }
?>
<div class=\"form-group\">
    <?php echo zen_draw_label('Edit File:', '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <?php echo zen_draw_file_field('" . $field . "', '', 'class=\"form-control\" id=\"" . $field . "\"'); ?>
        <?php echo zen_draw_hidden_field('" . $field . "_previous_file', \$pInfo->" . $field . " ?? ''); ?>
    </div>
</div>
<div class=\"form-group\">
    <p class=\"col-sm-3 control-label\"><?php echo \"Overwrite Existing File on Server?\"; ?></p>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '0', false) . TABLE_HEADING_NO; ?></label>
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '1', true) . TABLE_HEADING_YES; ?></label>
    </div>
</div>
<div class=\"form-group\">
    <?php echo zen_draw_label(\"Or, use an existing file from server, filename:\", '" . $field . "_file_manual', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <?php echo zen_draw_input_field('" . $field . "_file_manual', '', 'class=\"form-control\" id=\"" . $field . "_file_manual\"'); ?>
    </div>
</div>
<hr>";
            break;
        // video file upload field. stores filename, previews with <video> tag; interactive drag-drop UI
        case "video":
            $sql_type = "varchar(" . $length . ") DEFAULT NULL";
            $string_input_field = "<?php
\$_npf_" . $field . "_max_raw = ini_get('upload_max_filesize');
\$_npf_" . $field . "_max_bytes = (int)\$_npf_" . $field . "_max_raw;
switch (strtolower(substr(\$_npf_" . $field . "_max_raw, -1))) {
    case 'g': \$_npf_" . $field . "_max_bytes *= 1073741824; break;
    case 'm': \$_npf_" . $field . "_max_bytes *= 1048576; break;
    case 'k': \$_npf_" . $field . "_max_bytes *= 1024; break;
}
?>
<hr>
<h2><?php echo TEXT_" . $lang_defines . "; ?></h2>
<?php if (!empty(\$pInfo->" . $field . ")) { ?>
    <div class=\"form-group\">
        <div class=\"col-sm-offset-3 col-sm-9 col-md-6\">
            <?php echo zen_npf_video(\$pInfo->" . $field . "); ?>
            <small class=\"text-muted\"><?php echo htmlspecialchars(\$pInfo->" . $field . "); ?></small>
        </div>
    </div>
    <div class=\"form-group\">
        <p class=\"col-sm-3 control-label\"><?php echo 'Remove Video? Note: Removes from product (file is NOT deleted from server):'; ?></p>
        <div class=\"col-sm-9 col-md-6\">
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '0', true) . TABLE_HEADING_NO; ?></label>
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '1', false) . TABLE_HEADING_YES; ?></label>
        </div>
    </div>
<?php } ?>
<div class=\"form-group\">
    <?php echo zen_draw_label('Upload Video:', '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <div id=\"" . $field . "_drop_zone\"
             style=\"border:2px dashed #ccc;border-radius:6px;padding:28px 20px;text-align:center;cursor:pointer;background:#fafafa;transition:background .15s,border-color .15s;\"
             onclick=\"document.getElementById('" . $field . "').click()\"
             ondragover=\"event.preventDefault();this.style.background='#eef5ff';this.style.borderColor='#5b9bd5';\"
             ondragleave=\"this.style.background='#fafafa';this.style.borderColor='#ccc';\"
             ondrop=\"npfVideoDrop_" . $field . "(event)\">
            <span style=\"font-size:2.2em;\">&#127909;</span>
            <p style=\"color:#888;margin:8px 0 0;\">Drag &amp; drop a video or <strong>click to browse</strong></p>
            <p style=\"color:#bbb;font-size:12px;margin:6px 0 0;\">
                MP4 &middot; WebM &middot; OGG &mdash; max <?php echo htmlspecialchars(\$_npf_" . $field . "_max_raw); ?>
            </p>
            <p style=\"color:#e8a000;font-size:11px;margin:4px 0 0;\">
                &#9888; <strong>Recommended: MP4</strong> &mdash; MOV/AVI/MKV may not play in Chrome or Firefox.
            </p>
        </div>
        <?php echo zen_draw_file_field('" . $field . "', '', 'style=\"display:none;\" id=\"" . $field . "\" accept=\"video/*\"'); ?>
        <?php echo zen_draw_hidden_field('" . $field . "_previous_file', \$pInfo->" . $field . " ?? ''); ?>
        <div id=\"" . $field . "_npf_info\" style=\"display:none;margin-top:10px;\" class=\"alert alert-info\"></div>
        <div id=\"" . $field . "_npf_error\" style=\"display:none;margin-top:10px;\" class=\"alert alert-danger\"></div>
        <div id=\"" . $field . "_npf_preview\" style=\"display:none;margin-top:14px;\">
            <video id=\"" . $field . "_preview_player\" controls style=\"max-width:100%;max-height:220px;border-radius:4px;\" preload=\"metadata\"></video>
        </div>
    </div>
</div>
<div class=\"form-group\">
    <p class=\"col-sm-3 control-label\"><?php echo 'Overwrite Existing File on Server?'; ?></p>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '0', false) . TABLE_HEADING_NO; ?></label>
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '1', true) . TABLE_HEADING_YES; ?></label>
    </div>
</div>
<div class=\"form-group\">
    <?php echo zen_draw_label('Or, use an existing file from server, filename:', '" . $field . "_file_manual', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <?php echo zen_draw_input_field('" . $field . "_file_manual', '', 'class=\"form-control\" id=\"" . $field . "_file_manual\"'); ?>
    </div>
</div>
<script>
(function (\$) {
    var FIELD     = '" . $field . "';
    var ALLOWED   = ['mp4','webm','ogg','mov','avi','mkv','flv','m4v'];
    var MAX_BYTES = <?php echo (int)\$_npf_" . $field . "_max_bytes; ?>;

    function formatBytes(bytes) {
        if (bytes >= 1073741824) return (bytes / 1073741824).toFixed(2) + ' GB';
        if (bytes >= 1048576)    return (bytes / 1048576).toFixed(1) + ' MB';
        return (bytes / 1024).toFixed(0) + ' KB';
    }

    function handleFile(file) {
        var infoEl    = document.getElementById(FIELD + '_npf_info');
        var errEl     = document.getElementById(FIELD + '_npf_error');
        var previewEl = document.getElementById(FIELD + '_npf_preview');
        var player    = document.getElementById(FIELD + '_preview_player');
        var dropZone  = document.getElementById(FIELD + '_drop_zone');

        infoEl.style.display = errEl.style.display = previewEl.style.display = 'none';
        dropZone.style.background = '#fafafa';
        dropZone.style.borderColor = '#ccc';

        if (!file) return;

        var ext = file.name.split('.').pop().toLowerCase();
        var errors = [];

        if (ALLOWED.indexOf(ext) === -1) {
            errors.push('File type <strong>.' + ext + '</strong> is not allowed. Accepted: ' + ALLOWED.join(', ') + '.');
        }
        if (MAX_BYTES > 0 && file.size > MAX_BYTES) {
            errors.push(
                'File is <strong>' + formatBytes(file.size) + '</strong> &mdash; exceeds the server limit of <strong>' +
                formatBytes(MAX_BYTES) + '</strong>. The upload will be rejected. ' +
                'Ask your host to increase <code>upload_max_filesize</code> and <code>post_max_size</code> in php.ini.'
            );
        }

        if (errors.length) {
            errEl.innerHTML = errors.join('<br>');
            errEl.style.display = 'block';
            return;
        }

        infoEl.innerHTML = '&#10003; <strong>' + \$('<span>').text(file.name).html() + '</strong> &mdash; ' + formatBytes(file.size);
        infoEl.style.display = 'block';
        dropZone.style.background = '#f0fff0';
        dropZone.style.borderColor = '#5cb85c';

        // Warn about non-universal formats
        var LIMITED = ['mov','avi','mkv','flv'];
        if (LIMITED.indexOf(ext) !== -1) {
            errEl.innerHTML = '&#9888; <strong>.' + ext.toUpperCase() + ' has limited browser support</strong> &mdash; it may not play in Chrome or Firefox. Convert to <strong>MP4</strong> for best compatibility.';
            errEl.style.display = 'block';
        } else {
            errEl.style.display = 'none';
        }

        if (window.URL && window.URL.createObjectURL) {
            if (player.src && player.src.indexOf('blob:') === 0) {
                URL.revokeObjectURL(player.src);
            }
            player.src = URL.createObjectURL(file);
            previewEl.style.display = 'block';
        }
    }

    window.npfVideoDrop_" . $field . " = function (event) {
        event.preventDefault();
        var files = event.dataTransfer ? event.dataTransfer.files : null;
        if (!files || !files.length) return;
        // Assign to input so the file is included in form submission
        try {
            var dt = new DataTransfer();
            dt.items.add(files[0]);
            document.getElementById(FIELD).files = dt.files;
        } catch (e) {
            // DataTransfer not supported in this browser; show a warning
            var errEl = document.getElementById(FIELD + '_npf_error');
            errEl.innerHTML = 'Drag-and-drop file assignment is not supported in this browser. Please use the <strong>browse button</strong> above.';
            errEl.style.display = 'block';
            return;
        }
        handleFile(files[0]);
        // reset drop zone styling
        var dz = document.getElementById(FIELD + '_drop_zone');
        dz.style.background = '#fafafa';
        dz.style.borderColor = '#ccc';
    };

    \$(function () {
        var input = document.getElementById(FIELD);
        if (!input) return;

        \$(input).on('change', function () {
            handleFile(this.files[0] || null);
        });

        // Show an upload overlay when the form is submitted with a video selected
        \$(input).closest('form').on('submit', function () {
            if (input.files && input.files.length > 0) {
                \$('body').append(
                    '<div id=\"npf_video_uploading_" . $field . "\" style=\"position:fixed;top:0;left:0;width:100%;height:100%;' +
                    'background:rgba(0,0,0,.55);z-index:9999;display:flex;align-items:center;justify-content:center;\">' +
                    '<div class=\"text-center\" style=\"color:#fff;\">' +
                    '<p style=\"font-size:1.3em;margin-bottom:12px;\">&#8987; Uploading video&hellip; please wait.</p>' +
                    '<div class=\"progress\" style=\"width:260px;\">' +
                    '<div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" style=\"width:100%;\"></div>' +
                    '</div></div></div>'
                );
            }
            // Release object URL to avoid memory leak
            var player = document.getElementById(FIELD + '_preview_player');
            if (player && player.src && player.src.indexOf('blob:') === 0) {
                URL.revokeObjectURL(player.src);
            }
        });
    });
})(jQuery);
</script>
<hr>";
            break;
        case "checkbox":
            /*
                Checkbox doesn't go into form when its not checked.
                Hidden fild will fill the form with false value when Checkbox not present (unchecked).
                Checkbox will overwrite hidden field when its set to true.
            */
            $string_input_field = "<div class=\"form-group\">
    <?php echo zen_draw_label(TEXT_" . $lang_defines . ", '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-6\">
        <?php echo zen_draw_checkbox_field('" . $field . "', 1, (\$pInfo->" . $field . ") ? true : false, '', 'id=\"" . $field . "\"'); ?>
    </div>
</div>";
            $sql_type = "tinyint(1) NOT NULL DEFAULT 0";
            break;
        case "text":
        default:
            $sql_type = "varchar(" . $length . ") DEFAULT NULL";
            $string_input_field = "<div class=\"form-group\">
    <?php echo zen_draw_label(TEXT_" . $lang_defines . ", '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-6\">
        <?php echo zen_draw_input_field('" . $field . "', (\$pInfo->" . $field . "), 'class=\"form-control\" id=\"" . $field . "\"'); ?>
    </div>
</div>";
            break;
    }
    //files
    $admin_start_file = "<?php  

/**
 * File Generated by Numinix Product Fields
 * @package admin
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
";

    $string_npf_lang_file = "
\$define = [ 'TEXT_" . $lang_defines . "' => '" . $nice_field_name . ": ' ];
\$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if (\$zc158) {
    return \$define;
} else {
    nmx_create_defines(\$define);
}
// eof";
    $generated_files = [
        NPF_DEFINITIONS_FOLDER . $field . '.php' => $admin_start_file . $string_npf_lang_file,
    ];

    $string_npf_sql_file = "
\$parameters['" . $field . "'] = '';
\$npf_fields .= ', p." . $field . "'; 
// eof";
    $generated_files[NPF_INCLUDES_SQL_FOLDER . $field . '.php'] = $admin_start_file . $string_npf_sql_file;

    $string_npf_sql_array_file = "
if (isset(\$_POST['" . $field . "'])) {
    \$sql_data_array['" . $field . "'] = zen_db_prepare_input(\$_POST['" . $field . "']);
}";
    if ($is_upload) {
        $string_npf_sql_array_file .= "
if (isset(\$_POST['" . $field . "_file_delete']) && \$_POST['" . $field . "_file_delete'] === '1') {
    \$sql_data_array['" . $field . "'] = '';
}";
    }
    $generated_files[NPF_INCLUDES_SQL_ARRAY_FOLDER . $field . '.php'] = $admin_start_file . $string_npf_sql_array_file;

    $string_npf_templates_file = $string_input_field;
    $generated_files[NPF_INCLUDES_TEMPLATES_FOLDER . $field . '.php'] = $string_npf_templates_file;

    if ($is_upload) {
        $process_string = "";
        $generated_files[NPF_INCLUDES_PROCESSING_FOLDER . $field . '.php'] = $admin_start_file . $process_string;

        $set_extensions_line = ($type === 'video')
            ? "\n    \$products_" . $field . "->set_extensions(['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv', 'flv', 'm4v']);"
            : "";

        $manual_file_validation = ($type === 'video')
            ? "\$_video_manual_allowed = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv', 'flv', 'm4v'];
\$_video_manual_basename = basename(\$_POST['" . $field . "_file_manual']);
\$_video_manual_ext = strtolower(pathinfo(\$_video_manual_basename, PATHINFO_EXTENSION));
if (in_array(\$_video_manual_ext, \$_video_manual_allowed)) {
    \$products_" . $field . "_name = NPF_UPLOAD_FOLDER . '/' . \$_video_manual_basename;
}"
            : "\$products_" . $field . "_name = NPF_UPLOAD_FOLDER . '/' . basename(\$_POST['" . $field . "_file_manual']);";

        $preview_string = "
// upload file, if submitted
\$products_" . $field . "_name = '';
if (!isset(\$_GET['read']) || \$_GET['read'] !== 'only') {
    \$products_" . $field . " = new upload('" . $field . "');" . $set_extensions_line . "
    \$products_" . $field . "->set_destination(DIR_FS_CATALOG . NPF_UPLOAD_FOLDER . '/');
    if (\$products_" . $field . "->parse() && \$products_" . $field . "->save(isset(\$_POST['" . $field . "_overwrite']) ? \$_POST['" . $field . "_overwrite'] : false)) {
        \$products_" . $field . "_name = NPF_UPLOAD_FOLDER . '/' . \$products_" . $field . "->filename;
    } else {
        \$products_" . $field . "_name = (isset(\$_POST['" . $field . "_previous_file']) ? \$_POST['" . $field . "_previous_file'] : '');
    }
}
if (!empty(\$_POST['" . $field . "_file_manual'])) {
    " . $manual_file_validation . "
}
\$_POST['" . $field . "'] = \$products_" . $field . "_name;

";
        $generated_files[NPF_INCLUDES_PREVIEW_FOLDER . $field . '.php'] = $admin_start_file . $preview_string;
        $preview_info_string = '';
        $generated_files[NPF_INCLUDES_PREVIEW_INFO_FOLDER . $field . '.php'] = $admin_start_file . $preview_info_string;

        $custom_execute_string = "
if (!isset(\$products_id) || (int)\$products_id <= 0) {
    return;
}

if (isset(\$_POST['" . $field . "_file_delete']) && \$_POST['" . $field . "_file_delete'] === '1') {
    \$npf_" . $field . "_value = '';
} elseif (isset(\$_POST['" . $field . "'])) {
    \$npf_" . $field . "_value = zen_db_prepare_input(\$_POST['" . $field . "']);
} else {
    return;
}

\$sql = \"UPDATE \" . TABLE_PRODUCTS . \"
        SET " . $field . " = :npf_" . $field . ":
        WHERE products_id = \" . (int)\$products_id . \"
        LIMIT 1\";
\$sql = \$db->bindVars(\$sql, ':npf_" . $field . ":', \$npf_" . $field . "_value, 'string');
\$db->Execute(\$sql);
";
        $generated_files[NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER . $field . '.php'] = $admin_start_file . $custom_execute_string;

        // Generate catalog-side display module so the video shows on the product page
        if ($type === 'video') {
            $catalog_module = "<?php
// NPF catalog display module - auto-generated for field: " . $field . "
if (empty(\$product_info->fields['products_id'])) {
    return;
}
\$_npf_html = zen_npf_video(npf_field_value((int)\$product_info->fields['products_id'], '" . $field . "'));
if (\$_npf_html !== '') {
    \$GLOBALS['npf_product_extra_html'] .= '<div class=\"npf-video-field\" style=\"margin:12px 0\">'
        . '<strong>" . htmlspecialchars($nice_field_name, ENT_QUOTES) . "</strong><br>'
        . \$_npf_html
        . '</div>';
}
";
            $generated_files[$catalog_display_dir . $field . '.php'] = $catalog_module;
        }
    }
    $written_files = [];
    foreach ($generated_files as $filename => $contents) {
        if (!npf_write_generated_file($filename, $contents)) {
            foreach ($written_files as $written_file) {
                if (is_file($written_file)) {
                    unlink($written_file);
                }
            }
            $messageStack->add('ERROR!! Unable to write generated NPF file: ' . $filename, 'error');
            return;
        }
        $written_files[] = $filename;
    }

    // add the field to the DB
    $db->Execute("ALTER TABLE `" . DB_PREFIX . "products` ADD `" . $field . "` " . $sql_type . ";");
    $messageStack->add($nice_field_name . ' added', 'success');
}

// bof NX-2511: Program delete feature in NPF
function delete_custom_field($field)
{
    global $sniffer, $db, $messageStack;
    $field = npf_normalize_field_name($field);
    $validation_error = npf_validate_custom_field_name($field);
    if ($validation_error !== '') {
        $messageStack->add('ERROR!! ' . $validation_error, 'error');
        return;
    }

    $generated_files = [
        NPF_DEFINITIONS_FOLDER,
        NPF_INCLUDES_SQL_FOLDER,
        NPF_INCLUDES_MODULES_FOLDER,
        NPF_INCLUDES_DESCRIPTION_SQL_ARRAY_FOLDER,
        NPF_INCLUDES_SQL_ARRAY_FOLDER,
        NPF_INCLUDES_TEMPLATES_FOLDER,
        NPF_INCLUDES_PROCESSING_FOLDER,
        NPF_INCLUDES_PREVIEW_FOLDER,
        NPF_INCLUDES_PREVIEW_INFO_FOLDER,
        NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER,
        DIR_FS_CATALOG . 'includes/modules/npf_catalog_display/',
    ];
    foreach ($generated_files as $directory) {
        $filename = $directory . $field . '.php';
        if (is_file($filename)) {
            unlink($filename);
        }
    }

    ($sniffer->field_exists(TABLE_PRODUCTS, $field)) ? $db->Execute("ALTER TABLE `" . DB_PREFIX . "products` DROP `" . $field . "`;") : false;
    if (file_exists(NPF_INCLUDES_PREBUILT_FOLDER . $field . '/uninstall.sql')) {
        $query_string = file_get_contents(NPF_INCLUDES_PREBUILT_FOLDER . $field . '/uninstall.sql');
        npf_sql_patch($query_string);
    }
    $messageStack->add($field . ' deleted', 'success');
}
// eof NX-2511: Program delete feature in NPF
