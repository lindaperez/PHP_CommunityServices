<?php

    //Cabeceras para todos los correos a enviar del litoral
    $cabeceras_litoral = 'from: Coordinación Programa Servicio Comunitario <coord-psc@usb.ve>' . "\r\n";
    $cabeceras_litoral.= 'Cc: Kenyer Domínguez <kdoming@usb.ve>' . "\r\n";
    $cabeceras_litoral.= 'Bcc: <coord-psc@usb.ve>' . "\r\n";

    //Cabeceras para todos los correos a enviar de sartenejas
    $cabeceras_sartenejas = 'from: Coordinación Programa Servicio Comunitario <coord-psc@usb.ve>' . "\r\n";
    $cabeceras_sartenejas.= 'Cc: Kenyer Domínguez <kdoming@usb.ve>' . "\r\n";
    $cabeceras_sartenejas.= 'Bcc: <coord-psc@usb.ve>' . "\r\n";
    
    //Firma para todos los correos a enviar del Litoral
    $firma_litoral = '\r\n\r\n';
    $firma_litoral.= "Saludos".'\r\n';
    $firma_litoral.= "---".'\r\n';
    $firma_litoral.= "Programa de Servicio Comunitario.".'\r\n';
    $firma_litoral.= "Coordinación de Cooperación Técnica y Desarrollo Social.".'\r\n';
    $firma_litoral.= "Decanato de Extensión.".'\r\n';
    $firma_litoral.= "Universidad Simón Bolívar.".'\r\n';
    $firma_litoral.= "Básico I, 1er Piso, Tel. 9063378.".'\r\n';
    $firma_litoral.= "www.cctds.dex.usb.ve".'\r\n';
    $firma_litoral.= "@usbcomunitario".'\r\n';
    
    //Firma para todos los correos a enviar de Sartenejas
    $firma_sartenejas = '\r\n\r\n';
    $firma_sartenejas.= "Saludos".'\r\n';
    $firma_sartenejas.= "---".'\r\n';
    $firma_sartenejas.= "Programa de Servicio Comunitario.".'\r\n';
    $firma_sartenejas.= "Coordinación de Cooperación Técnica y Desarrollo Social.".'\r\n';
    $firma_sartenejas.= "Decanato de Extensión.".'\r\n';
    $firma_sartenejas.= "Universidad Simón Bolívar.".'\r\n';
    $firma_sartenejas.= "Básico I, 1er Piso, Tel. 9063378.".'\r\n';
    $firma_sartenejas.= "www.cctds.dex.usb.ve".'\r\n';
    $firma_sartenejas.= "@usbcomunitario".'\r\n';
    
    //Se define la cabecera y la firma del correo segun la sede
    if ($_SESSION[sede]=='Litoral'){
        $cabeceras=$cabeceras_litoral;
        $firma=$firma_litoral;
    }
    else{
        $cabeceras=$cabeceras_sartenejas;
        $firma=$firma_sartenejas;
    }
    
    //Inscripcion satisfactoria del servicio comunitario
    $asunto_ins_apr = "Inscripción satisfactoria del Servicio Comunitario.";
    
    $correo_ins_apr.= "Hemos recibido exitosamente los recaudos para su Servicio Comunitario.".'\r\n';
    $correo_ins_apr.= "Recuerde que usted tiene minimo 90 dias y maximo una anio para realizar su proyecto".'\r\n';
    //$correo_ins_apr.= $firma;
    
    //Problema con inscripcion de servicio comunitario
    $asunto_ins_no_apr = "URGENTE: Problema con inscripción del Servicio Comunitario.";
    
    $correo_ins_no_apr.= "Al parecer ha ocurrido un problema con su inscripción del Servicio ";
    $correo_ins_no_apr.= "Comunitario, le recomendamos ingresar al sistema para verificar y en ";
    $correo_ins_no_apr.= "caso de que el problema persista, acercarse a la CCTDS.".'\r\n';
    $correo_ins_no_apr.= $firma;
    
    //Eliminar inscripcion de servicio comunitario
    $asunto_ins_elim = "URGENTE: Eliminada inscripción del Servicio Comunitario.";
    
    $correo_ins_elim.= "Se ha eliminado su inscripción de Servicio Comunitario , si ";
    $correo_ins_elim.= "desconoce la causa, por favor acercarse a la CCTDS. En caso contrario, ";
    $correo_ins_elim.= "omita este correo.".'\r\n';
    $correo_ins_elim.= $firma;
    
    //Culminacion satisfactoria del servicio comunitario
    $asunto_cert_apr = "Culminación satisfactoria del Servicio Comunitario.";
    
    $correo_cert_apr.= "Se ha certificado la culminación de su servicio comunitario.".'\r\n';
    //$correo_cert_apr.= $firma;
    
    //Problema con la culminacion del servicio comunitario
    $asunto_cert_no_apr = "URGENTE: Problema con culminación de su Servicio Comunitario.";
    
    $correo_cert_no_apr.= "Al parecer ha ocurrido un problema con la culminación de su Servicio ";
    $correo_cert_no_apr.= "Comunitario, dado que su informe final no era el correcto, por lo tanto ";
    $correo_cert_no_apr.= "fue eliminado para que usted suba de nuevo una versión mejorada. ";
    $correo_cert_no_apr.= "Si tiene alguna observación o duda, puede dirigirse a la CCTDS.".'\r\n';
    $correo_cert_no_apr.= $firma;
    
?>
