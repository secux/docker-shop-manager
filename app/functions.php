<?php

function cleanTag($tag)
{
	// if it contains the substring "tags/" it means the list was pulled 
	// from github so everything but the tag itself should be removed
	if (strpos($tag, "tags/")) {
		    $string = strstr($tag, 'tags/');
            $ver = str_replace("tags/", "", $string);
	} else {
		// perhaps more code will be needed here
		$ver = $tag;
	}
	return $ver;
}