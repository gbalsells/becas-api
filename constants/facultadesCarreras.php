<?php

include_once 'models/facultad.php';

$agro = new Facultad();
$arq = new Facultad();
$art = new Facultad();
$bioq = new Facultad();
$facet = new Facultad();
$lillo = new Facultad();
$der = new Facultad();
$edf = new Facultad();
$filo = new Facultad();
$med = new Facultad();
$odonto = new Facultad();
$psico = new Facultad();
$cine = new Facultad();
$econ = new Facultad();

$agroCarreras = array(
    "INGENIERÍA AGRONÓMICA", "INGENIERÍA ZOOTECNISTA", "MEDICINA VETERINARIA", "TECNICATURA UNIVERSITARIA DE GESTIÓN EN CALIDAD ALIMENTICIA", "TECNICATURA UNIVERSITARIA EN AGROINDUSTRIAS"
);
$arqCarreras = array(
    "ARQUITECTURA", "TECNICATURA UNIVERSITARIA EN DISEÑO DE INDUMENTARIA Y TEXTIL"
);
$artCarreras = array(
    "BAILARIN DE DANZA CONTEMPORANEA",
    "DISEÑADOR DE INTERIORES Y EQUIPAMIENTO",
    "INTERPRETE DRAMATICO",
    "LICENCIATURA EN ARTES VISUALES",
    "LICENCIATURA EN MÚSICA",
    "LICENCIATURA EN TEATRO",
    "PROFESORADO EN DANZA CONTEMPORÁNEA",
    "PROFESORADO EN JUEGOS TEATRALES",
    "PROFESORADO EN TEATRO",
    "TECNICATURA UNIVERSITARIO EN CONSTRUCCIÓN Y RESTAURACIÓN DE CUERDAS PULSADAS",
    "TECNICATURA UNIVERSITARIO EN FOTOGRAFIA",
    "TECNICATURA UNIVERSITARIO EN SONORIZACION"
);
$bioqCarreras = array(
    "BIOQUIMICO",
    "FARMACEUTICO",
    "LICENCIATURA EN BIOTECNOLOGIA",
    "LICENCIATURA EN QUIMICA",
    "TECNICATURA LABORATORISTA UNIVERSITARIO EN SALUD",
    "TECNICATURA UNIVERSITARIA EN SANEAMIENTO Y DESINFECCION DE LOS SERVICIOS DE SALUD"
);
$facetCarreras = array(
    "DISEÑADOR DE ILUMINACIÓN",
    "INGENIERIA EN  AGRIMENSURA",
    "INGENIERIA AZUCARERA",
    "INGENIERIA BIOMEDICA",
    "INGENIERIA CIVIL",
    "INGENIERIA ELECTRICISTA",
    "INGENIERIA ELECTRONICA",
    "INGENIERIA EN COMPUTACION",
    "INGENIERIA EN SISTEMAS",
    "INGENIERÍA EN GEODESIA Y GEOFISICA",
    "INGENIERIA INDUSTRIAL",
    "INGENIERIA MECANICO",
    "INGENIERIA QUIMICO",
    "LICENCIATURA EN FISICA",
    "LICENCIATURA EN INFORMATICA",
    "LICENCIATURA EN MATEMATICA",
    "PROGRAMADOR UNIVERSITARIO",
    "TECNICATURA EN ILUMINACION",
    "TECNICATURA UNIVERSITARIA EN FISICA",
    "TECNICATURA UNIVERSITARIA EN FISICA AMBIENTAL",
    "TECNICATURA UNIVERSITARIA EN TECNOLOGIA AZUCARERA E INDUSTRIAS DERIVADAS"
);
$lilloCarreras = array(
    "ARQUEOLOGIA",
    "GEOLOGIA",
    "LICENCIATURA EN CIENCIAS BIOLOGICAS",
    "PROFESORADO EN CIENCIAS BIOLOGICAS",
    "TECNICATURA EN DOCUMENTACION Y MUSEOLOGIA ARQUEOLOGICA"
);
$derCarreras = array(
    "ABOGACIA",
    "ESCRIBANIA",
    "PROCURACION "
);
$edfCarreras = array(
    "LICENCIATURA EN EDUCACION FISICA",
    "PROFESORADO EN EDUCACION FISICA"
);
$filoCarreras = array(
    "LICENCIATURA EN CIENCIAS DE LA COMUNICACIÓN",
    "LICENCIATURA EN CIENCIAS DE LA EDUCACION",
    "LICENCIATURA EN FILOSOFIA",
    "LICENCIATURA EN FRANCES",
    "LICENCIATURA EN GEOGRAFIA",
    "LICENCIATURA EN HISTORIA",
    "LICENCIATURA EN INGLES",
    "LICENCIATURA EN LETRAS",
    "LICENCIATURA EN TRABAJO SOCIAL",
    "PROFESORADO EN ARTES PLASTICAS (CICLO PROFESORADO)",
    "PROFESORADO EN CIENCIAS ECONOMICAS",
    "PROFESORADO EN CIENCIAS DE LA EDUCACION",
    "PROFESORADO EN FILOSOFIA",
    "PROFESORADO EN FRANCES",
    "PROFESORADO EN GEOGRAFIA",
    "PROFESORADO EN HISTORIA",
    "PROFESORADO EN INGLES",
    "PROFESORADO EN LETRAS",
    "PROFESORADO EN MATEMATICAS",
    "PROFESORADO EN QUIMICA",
    "TECNICATURA UNIVERSITARIA EN COMUNICACIÓN"
);
$medCarreras = array(
    "MEDICINA",
    "KINESIOLOGÍA",
    "LICENCIATURA EN KINESIOLOGÍA",
    "ENFERMERIA  (TÍTULO INTERMEDIO)",
    "LICENCIATURA EN ENFERMERÍA",
    "LICENCIATURA EN OBSTETRICIA",
    "TECNICATURA EN ESTADÍSTICAS DE SALUD",
    "TÉCNICO EN INSTRUMENTACIÓN QUIRÚRGICA"
);
$odontoCarreras = array(
    "TECNICATURA UNIVERSITARIA EN ASISTENTE DENTAL",
    "ODONTÓLOGO"
);
$psicoCarreras = array(
    "PSICOLOGO",
    "TECNICATURA UNIVERSITARIA EN ACOMPAÑAMIENTO TERAPEUTICO"
);
$cineCarreras = array(
    "LICENCIATURA EN CINEMATOGRAFÍA",
    "TECNICATURA UNIVERSITARIA EN MEDIOS AUDIOVISUALES"
);
$econCarreras = array(
    "CONTADOR PUBLICO NACIONAL",
    "LICENCIATURA EN ADMINISTRACIÓN",
    "LICENCIATURA EN ECONOMIA"
);


$agro->setCarreras($agroCarreras);
$arq->setCarreras($arqCarreras);
$art->setCarreras($artCarreras);
$bioq->setCarreras($bioqCarreras);
$facet->setCarreras($facetCarreras);
$lillo->setCarreras($lilloCarreras);
$der->setCarreras($derCarreras);
$edf->setCarreras($edfCarreras);
$filo->setCarreras($filoCarreras);
$med->setCarreras($medCarreras);
$odonto->setCarreras($odontoCarreras);
$psico->setCarreras($psicoCarreras);
$cine->setCarreras($cineCarreras);
$econ->setCarreras($econCarreras);

$agro->setNombre('FACULTAD DE AGRONOMIA Y ZOOTECNIA');
$arq->setNombre('FACULTAD DE ARQUITECTURA Y URBANISMO');
$art->setNombre('FACULTAD DE DE ARTES');
$bioq->setNombre('FACULTAD DE BIOQUIMICA, QUIMICA Y FARMACIA');
$facet->setNombre('FACULTAD DE CIENCIAS EXACTAS Y TECNOLOGIA');
$lillo->setNombre('FACULTAD DE CIENCIAS NATURALES E INSTITUTO MIGUEL LILLO');
$der->setNombre('FACULTAD DE DERECHO Y CIENCIAS SOCIALES');
$edf->setNombre('FACULTAD DE EDUCACION FISICA');
$filo->setNombre('FACULTAD DE FILOSOFIA Y LETRAS');
$med->setNombre('FACULTAD DE MEDICINA Y ESCUELA UNIVERSITARIA DE ENFERMERIA');
$odonto->setNombre('FACULTAD DE ODONTOLOGÍA');
$psico->setNombre('FACULTAD DE PSICOLOGIA');
$cine->setNombre('ESCUELA UNIVERSITARIA DE CINE, VIDEO Y TELEVISION');
$econ->setNombre('FACULTAD DE CIENCIAS ECONOMICAS');


$facultades = [
    $agro,
    $arq,
    $art,
    $bioq,
    $facet,
    $lillo,
    $der,
    $edf,
    $filo,
    $med,
    $odonto,
    $psico,
    $cine,
    $econ
];

/*
foreach ($facultades as $facu){
    echo '<b>' .$facu->getNombre() .'</b><br/>';
    $carreras = $facu->getCarreras();
    foreach ($carreras as $carr) {
        echo $carr .'<br/>';
    }
}

*/

?>