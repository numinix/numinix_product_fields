<?php

/**
 * npf_field_value to obtain a product field for display/use in catalog
 * Example use of function:
 * echo npf_field_value($product_id, 'products_msrp');
 */

if (!function_exists('npf_field_value')) {
    function npf_field_value($id, $field)
    {
        global $db;
        $product = $db->Execute("SELECT * FROM " . TABLE_PRODUCTS . " WHERE products_id = " . (int)$id . " LIMIT 1");
        return $product->fields[$field] ?? null;
    }
}

if (!function_exists('npf_upload_folder')) {
    function npf_upload_folder()
    {
        static $uploadFolder = null;

        if ($uploadFolder !== null) {
            return $uploadFolder;
        }

        if (defined('NPF_UPLOAD_FOLDER')) {
            $uploadFolder = NPF_UPLOAD_FOLDER;
            return $uploadFolder;
        }

        if (!defined('TABLE_CONFIGURATION')) {
            $uploadFolder = '';
            return $uploadFolder;
        }

        global $db;
        if (!isset($db)) {
            $uploadFolder = '';
            return $uploadFolder;
        }

        $configuration = $db->Execute(
            "SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'NPF_UPLOAD_FOLDER' LIMIT 1"
        );
        $uploadFolder = $configuration->fields['configuration_value'] ?? '';

        return $uploadFolder;
    }
}

if (!function_exists('npf_validate_video_path')) {
    function npf_validate_video_path($relativePath)
    {
        if (empty($relativePath) || !is_string($relativePath) || strpos($relativePath, "\0") !== false) {
            return '';
        }

        $uploadFolder = trim(str_replace('\\', '/', npf_upload_folder()), '/');
        if ($uploadFolder === '') {
            return '';
        }

        $relativePath = ltrim(str_replace('\\', '/', trim($relativePath)), '/');
        if ($relativePath === ''
            || preg_match('#^[a-z][a-z0-9+.-]*:#i', $relativePath)
            || strpos($relativePath, '//') === 0
            || ($relativePath !== $uploadFolder && strpos($relativePath, $uploadFolder . '/') !== 0)
        ) {
            return '';
        }

        $base = realpath(rtrim(DIR_FS_CATALOG, '/\\') . '/' . $uploadFolder);
        $candidate = realpath(rtrim(DIR_FS_CATALOG, '/\\') . '/' . $relativePath);
        if ($base === false || $candidate === false || !is_file($candidate) || !is_readable($candidate)) {
            return '';
        }

        $base = rtrim(str_replace('\\', '/', $base), '/') . '/';
        $candidate = str_replace('\\', '/', $candidate);
        if (strpos($candidate, $base) !== 0) {
            return '';
        }

        $mime_map = [
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',
            'ogg'  => 'video/ogg',
            'mov'  => 'video/quicktime',
            'avi'  => 'video/x-msvideo',
            'mkv'  => 'video/x-matroska',
            'm4v'  => 'video/x-m4v',
            'flv'  => 'video/x-flv',
        ];
        $ext = strtolower(pathinfo($candidate, PATHINFO_EXTENSION));
        if (!isset($mime_map[$ext])) {
            return '';
        }

        return $uploadFolder . '/' . substr($candidate, strlen($base));
    }
}

if (!function_exists('zen_npf_video')) {
    /**
     * Renders an HTML5 video player for an NPF video field value.
     *
     * @param string $npf_video Relative path to the video file (e.g. "npf_uploads/my-video.mp4")
     * @return string  HTML video element, or empty string if path is empty/missing/invalid
     */
    function zen_npf_video($npf_video)
    {
        $npf_video = npf_validate_video_path($npf_video);
        if ($npf_video === '') {
            return '';
        }

        // Use HTTPS when the current page is SSL to avoid mixed-content blocks
        global $request_type;
        $server_base = (isset($request_type) && $request_type === 'SSL') ? HTTPS_SERVER : HTTP_SERVER;
        $video_url   = $server_base . DIR_WS_CATALOG . $npf_video;

        $mime_map = [
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',
            'ogg'  => 'video/ogg',
            'mov'  => 'video/quicktime',
            'avi'  => 'video/x-msvideo',
            'mkv'  => 'video/x-matroska',
            'm4v'  => 'video/x-m4v',
            'flv'  => 'video/x-flv',
        ];
        $ext      = strtolower(pathinfo($npf_video, PATHINFO_EXTENSION));
        $type_attr = isset($mime_map[$ext]) ? ' type="' . $mime_map[$ext] . '"' : '';

        return '<video controls style="max-width:100%;max-height:360px;" preload="metadata">'
             . '<source src="' . htmlspecialchars($video_url, ENT_QUOTES, 'UTF-8') . '"' . $type_attr . '>'
             . 'Your browser does not support the video tag.'
             . '</video>';
    }
}
