<?php

if (!function_exists('html_escapee')) {

    function html_escapee($value)
    {
        if (is_array($value)) {
            return array_map('html_escapee', $value);
        }

        if ($value instanceof Stringable) {
            $value = (string) $value;
        }

        if (is_string($value) || is_numeric($value)) {

            return htmlspecialchars(
                (string) $value,
                ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
                'UTF-8',
                /* double_encode */
                false
            );
        }

        // Leave other types (null, bool, resources) as-is
        return $value;
    }
}

if (!function_exists('sanitize_xss_input')) {
    /**
     * Sanitizes input to prevent XSS attacks by removing potentially malicious content
     * such as script tags, event handlers, and other dangerous HTML attributes.
     *
     * @param string $input The input string to sanitize
     * @return string The sanitized input
     */
    function sanitize_xss_input($input)
    {
        if (!is_string($input)) {
            return '';
        }

        // Remove all HTML tags and encode special characters
        $sanitized = htmlspecialchars(strip_tags($input), ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

        // Remove potentially dangerous attributes and event handlers
        $dangerous_patterns = [
            '/\son\w+\s*=/i',          // Remove event handlers like onerror, onclick, etc.
            '/\sjavascript\s*:/i',     // Remove javascript: protocol
            '/\sdata\s*:/i',           // Remove data: protocol
            '/\svbscript\s*:/i',       // Remove vbscript: protocol
            '/\sexpression\s*\(/i',    // Remove CSS expressions
            '/\sxlink:href\s*=/i',     // Remove xlink:href attribute
            '/\sformaction\s*=/i',      // Remove formaction attribute
            '/\saction\s*=/i',          // Remove action attribute
        ];

        foreach ($dangerous_patterns as $pattern) {
            $sanitized = preg_replace($pattern, '', $sanitized);
        }

        return $sanitized;
    }
}
