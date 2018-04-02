<?php 

use GrahamCampbell\Markdown\Facades\Markdown;

function markdown(string $text): string 
{
    return Markdown::convertToHtml($text);
}