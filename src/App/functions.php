<?php
function parser($server_host, $server_uri) {
    $url = "http://".$server_host.$server_uri;
    $uri = parse_url(strtolower($url));
    $partes = explode("/", substr($uri['path'], 1));
    if($partes[0] == 'hsladderstats')
        array_shift($partes);

    return $partes;
}
