<?php

if (! function_exists('gravatar')) {
    /**
     * Get a gravatar image URL for a given email address.
     *
     * @param string $email An email address
     * @param int    $size  The desired image dimensions
     *
     * @return string
     */
    function gravatar(string $email, int $size = null)
    {
        $hash = md5(strtolower(trim($email)));
        $queryString = http_build_query(['s' => $size]);

        if (! empty($queryString)) {
            $queryString = '?' . $queryString;
        }

        return "https://www.gravatar.com/avatar/{$hash}{$queryString}";
    }
}

if (! function_exists('markdown')) {
    /**
     * Parse a string of markdown into HTML.
     *
     * @param string $input
     *
     * @return string
     */
    function markdown(string $input)
    {
        return '<article class="markdown" v-pre>' . (new Parsedown)->text($input) . '</article>';
    }

    /**
     * Parse a string of markdown into a line of HTML.
     *
     * @param string $input
     *
     * @return string
     */
    function markdownInline(string $input)
    {
        return '<span class="markdown" v-pre>' . (new Parsedown)->line($input) . '</span>';
    }
}
