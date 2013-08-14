#USECASE : Block would useful to remove X-PingBack Header from http response
//remove xpingback header
function remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'remove_x_pingback');


#USECASE : Disable XMLRPC Class compeletely
/*Disable complete xmlrpc class. */
add_filter( 'wp_xmlrpc_server_class', '__return_false' );
add_filter('xmlrpc_enabled', '__return_false');