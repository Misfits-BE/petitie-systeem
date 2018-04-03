<?php 

use GrahamCampbell\Markdown\Facades\Markdown;

/**
 * Convert markdown text to HTML code. 
 * 
 * @param  string $text The markdown text that needs to be converted to HTML
 * @return string
 */
function markdown(string $text): string 
{
    return Markdown::convertToHtml($text);
}