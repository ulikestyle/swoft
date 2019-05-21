<?php

use Swoft\Context\Context;
use Swoft\Http\Message\ContentType;

/**
 * Custom global functions
 */

if(!function_exists('viewHtml'))
{
    function viewHtml($content){

        return Context::mustGet()
            ->getResponse()
            ->withContentType(ContentType::HTML)
            ->withContent($content);

    }
}
