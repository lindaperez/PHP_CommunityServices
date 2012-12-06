<?php

function browser_works() {
    $_SERVER['HTTP_USER_AGENT'];
    
    $navegador=get_browser(null,true);
    
    $valido=true;
    // you can add different browsers with the same way ..
    if($navegador[browser]=='Chromium')
        if ($navegador[version]<16)
            $valido=false;
    if($navegador[browser]=='Chrome')
        if ($navegador[version]<15)
            $valido=false;
    if($navegador[browser]=='Safari')
        if ($navegador[version]<5)
            $valido=false;
    if($navegador[browser]=='Opera')
        if ($navegador[version]<11)
            $valido=false;
    if($navegador[browser]=='IE')
        if ($navegador[version]<8)
            $valido=false;
    if($navegador[browser]=='Mozilla')
        if ($navegador[version]<1.7)
            $valido=false;
    if($navegador[browser]=='Firefox')
        if ($navegador[version]<8)
            $valido=false;


    return $valido;

    
}
?>
