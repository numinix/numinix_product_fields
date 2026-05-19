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

if (!function_exists('zen_npf_video')) {
    /**
     * Renders an HTML5 video player for an NPF video field value.
     *
     * @param string $npf_video Relative path to the video file (e.g. "npf_uploads/my-video.mp4")
     * @return string  HTML video element, or empty string if path is empty/missing/invalid
     */
    function zen_npf_video($npf_video)
    {
        if (empty($npf_video) || !is_string($npf_video)) {
            return '';
        }

        // Prevent path traversal (catches both slash styles)
        $npf_video = preg_replace('#\.\.[/\\\\]#', '', $npf_video);
        $npf_video = ltrim($npf_video, '/\\');

        $abs_path = DIR_FS_CATALOG . $npf_video;
        if (!file_exists($abs_path) || !is_file($abs_path)) {
            return '';
        }

        // Use HTTPS when the current page is SSL to avoid mixed-content blocks
        global $request_type;
        $server_base = (isset($request_type) && $request_type === 'SSL') ? HTTPS_SERVER : HTTP_SERVER;
        $video_url   = $server_base . DIR_WS_CATALOG . $npf_video;

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
        $ext      = strtolower(pathinfo($npf_video, PATHINFO_EXTENSION));
        $type_attr = isset($mime_map[$ext]) ? ' type="' . $mime_map[$ext] . '"' : '';

        return '<video controls style="max-width:100%;max-height:360px;" preload="metadata">'
             . '<source src="' . htmlspecialchars($video_url, ENT_QUOTES, 'UTF-8') . '"' . $type_attr . '>'
             . 'Your browser does not support the video tag.'
             . '</video>';
    }
}
