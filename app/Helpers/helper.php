<?php
function activeMenu($uri = '') {
    $active = '';
    $uri = str_replace('_', '-', $uri);
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}
