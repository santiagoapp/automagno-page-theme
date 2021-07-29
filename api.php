<?php

function listarCategoriasASC() {
    $return = array();

    $cadena_json = '{"query":"query CarCategoryByOrder\\r\\n    {\\r\\n    carCategoryByOrder(\\r\\n      contentType: \\"CarCategory\\", filter: {isActive: {eq: 1}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        orden\\r\\n        name\\r\\n        description\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json),true);
    $response = $response["data"]["carCategoryByOrder"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["name"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarCategoriasASC", "listarCategoriasASC");
add_action("wp_ajax_nopriv_listarCategoriasASC", "listarCategoriasASC");

function listarEstadosASC() {
    $post_id = $_POST["value"];

    $cadena_json = '{"query":"query CarStatesByCategory\\r\\n    {\\r\\n    carStatesByCategory(\\r\\n      categoryId: \\"'. $post_id .'\\",\\r\\n      filter: {isActive: {eq: 1}, name:{eq: \\"Usado\\"}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        orden\\r\\n        name\\r\\n        description\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["carStatesByCategory"]["items"];

    foreach ($response as $item) {
        $return = $item["id"];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarEstadosASC", "listarEstadosASC");
add_action("wp_ajax_nopriv_listarEstadosASC", "listarEstadosASC");

function listarModelosASC() {
    $return = array();

    $post_id = $_POST["value"];

    $cadena_json = '{"query":"query CarModelsByCarState\\r\\n    {\\r\\n    carModelsByCarState(\\r\\n      carStateId: \\"'. $post_id .'\\",\\r\\n      filter: {isActive: {eq: 1}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        orden\\r\\n        name\\r\\n        description\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["carModelsByCarState"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["name"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarModelosASC", "listarModelosASC");
add_action("wp_ajax_nopriv_listarModelosASC", "listarModelosASC");

function listarMarcasASC() {
    $return = array();

    $post_id = $_POST["value"];

    $cadena_json = '{"query":"  query CarBrandsByCarModel\\r\\n    {\\r\\n    carBrandsByCarModel(\\r\\n      carModelId: \\"'. $post_id .'\\"\\r\\n      filter: {isActive: {eq: 1}}      \\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        orden\\r\\n        name\\r\\n        description\\r\\n        }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["carBrandsByCarModel"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["name"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarMarcasASC", "listarMarcasASC");
add_action("wp_ajax_nopriv_listarMarcasASC", "listarMarcasASC");

function listarLineasASC() {
    $return = array();

    $post_id = $_POST["value"];

    $cadena_json = '{"query":"  query CarLinesByBrand\\r\\n    {\\r\\n    carLinesByBrand(\\r\\n      brandId: \\"'. $post_id .'\\"\\r\\n      filter: {isActive: {eq: 1}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        name\\r\\n        description\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["carLinesByBrand"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["name"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarLineasASC", "listarLineasASC");
add_action("wp_ajax_nopriv_listarLineasASC", "listarLineasASC");

function listarVersionesASC() {
    $return = array();

    $post_id = $_POST["value"];

    $cadena_json = '{"query":"  query CarVersionsByLine\\r\\n    {\\r\\n    carVersionsByLine(\\r\\n      carLineId: \\"'. $post_id .'\\"\\r\\n      filter: {isActive: {eq: 1}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        referenciaUno\\r\\n        referenciaDos\\r\\n        referenciaTres\\r\\n        cilindraje\\r\\n        peso\\r\\n        potencia\\r\\n        capacidadPasajeros\\r\\n        valor\\r\\n        puertas\\r\\n        tipoCaja\\r\\n        combustible\\r\\n        transmision\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["carVersionsByLine"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["referenciaUno"]." ".$item["referenciaDos"]." ".$item["referenciaTres"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarVersionesASC", "listarVersionesASC");
add_action("wp_ajax_nopriv_listarVersionesASC", "listarVersionesASC");

function listarCiudadesASC() {
    $return = array();

    $post_id = $_POST["value"];

    $cadena_json = '{"query":"  query CitiesByCountry\\r\\n    {\\r\\n    citiesByCountry(\\r\\n      countryId: \\"' . $post_id .'\\"\\r\\n      filter: {isActive: {eq: 1}}\\r\\n    ) {\\r\\n      items {\\r\\n        id\\r\\n        name\\r\\n        name2\\r\\n        description\\r\\n        cityCode\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["citiesByCountry"]["items"];

    foreach ($response as $item) {
        $return += [$item["id"]=> $item["name"]];
    }

    wp_send_json( $return );
}
add_action("wp_ajax_listarCiudadesASC", "listarCiudadesASC");
add_action("wp_ajax_nopriv_listarCiudadesASC", "listarCiudadesASC");

function crearPersonaASC() {
    $return = array();

    $post_email = $_POST['data'][1][value];
    $post_name = $_POST['data'][0][value];
    $post_number = $_POST['data'][2][value];

    $cadena_json = '{"query":"mutation CreatePerson {\\r\\n  createPerson(input: {\\r\\n      contentType: \\"Person\\", \\r\\n      email: \\"'. $post_email .'\\", \\r\\n      fullname: \\"'. $post_name .'\\", \\r\\n      telephone: \\"'. $post_number .'\\",\\r\\n      isActive: 1\\r\\n      }) {\\r\\n    id\\r\\n    fullname\\r\\n    email\\r\\n    telephone\\r\\n  }\\r\\n}\\r\\n","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    $response = $response["data"]["createPerson"]["id"];

    $return = $response;

    wp_send_json( $return );
}
add_action("wp_ajax_crearPersonaASC", "crearPersonaASC");
add_action("wp_ajax_nopriv_crearPersonaASC", "crearPersonaASC");

function crearCarASC() {
    $return = array();

    $post_stageId = "c5adad4d-9057-44b7-85f2-964ffa735c24";
    $post_carStageId = "c5adad4d-9057-44b7-85f2-964ffa735c24";
    $post_carVersionId = $_POST['data'][7][value];
    $post_carBusinessModelId = "0743f05c-2271-498e-9b91-a195aa07f33d";
    $post_businessModelId = "0743f05c-2271-498e-9b91-a195aa07f33d";
    $post_kilometraje = $_POST['data'][10][value];
    $post_kilometraje = $_POST['data'][10][value];

    $cadena_json = '{"query":"mutation CreateCar {\\r\\n  createCar(input: {\\r\\n      contentType: \\"Car\\", \\r\\n      stageId: \\"'. $post_stageId .'\\", \\r\\n      carStageId: \\"'. $post_carStageId .'\\", \\r\\n      carVersionId: \\"'. $post_carVersionId .'\\",\\r\\n      carBusinessModelId: \\"'. $post_carBusinessModelId .'\\",\\r\\n      businessModelId: \\"'. $post_businessModelId .'\\",\\r\\n      kilometraje: \\"'. $post_kilometraje .'\\",\\r\\n      isActive: 1\\r\\n      }) {\\r\\n    id\\r\\n  }\\r\\n}\\r\\n","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    
    if ($response.data == null){
        $return = $response["errors"];
    }else{
        $response = $response["data"]["createCar"]["id"];
        $return = $response;
    }
    wp_send_json( $return );
}
add_action("wp_ajax_crearCarASC", "crearCarASC");
add_action("wp_ajax_nopriv_crearCarASC", "crearCarASC");

function crearRetomaASC() {
    $return = array();

    $post_contentType = "Retoma";
    $post_personId = $_POST['personId'];
    $post_carId = $_POST['carId'];
    $post_versionId = $_POST['data'][7][value];
    $post_placa = $_POST['data'][8][value];
    $post_ciudadPlacaId = $_POST['data'][9][value];
    $post_kilometraje = $_POST['data'][10][value];
    $post_color = $_POST['data'][11][value];
    $post_description = $_POST['data'][13][value];
    $post_transmission = $_POST['data'][12][value];
    $post_retomaBusinessModelId = "0743f05c-2271-498e-9b91-a195aa07f33d";

    $cadena_json = '{"query":"mutation CreateRetoma\\r\\n    {\\r\\n    createRetoma(input: {\\r\\n        contentType: \\"'. $post_contentType .'\\",\\r\\n        retomaPersonId: \\"'. $post_personId .'\\", \\r\\n        personId: \\"'. $post_personId .'\\", \\r\\n        retomaCarId: \\"'. $post_carId .'\\", \\r\\n        retomaVersionId: \\"'. $post_versionId .'\\", \\r\\n        versionId: \\"'. $post_versionId .'\\",\\r\\n        placa: \\"'. $post_placa .'\\", \\r\\n        retomaCiudadPlacaId: \\"'. $post_ciudadPlacaId .'\\", \\r\\n        ciudadPlacaId: \\"'. $post_ciudadPlacaId .'\\", \\r\\n        kilometraje: \\"'. $post_kilometraje .'\\", \\r\\n        color: \\"'. $post_color .'\\", \\r\\n        retomaBusinessModelId: \\"'. $post_retomaBusinessModelId .'\\", \\r\\n        transmission: \\"'. $post_transmission .'\\", \\r\\n        description: \\"'. $post_description .'\\", \\r\\n        isActive: 1}) {\\r\\n      id\\r\\n      placa\\r\\n      kilometraje\\r\\n      color\\r\\n      photos {\\r\\n        items {\\r\\n          id\\r\\n          bucket\\r\\n          key\\r\\n          ext\\r\\n          description\\r\\n        }\\r\\n      }\\r\\n      person {\\r\\n        id\\r\\n        identityNum\\r\\n        firstName\\r\\n        secondName\\r\\n        firstLastname\\r\\n        secondLastname\\r\\n        telephone\\r\\n        email\\r\\n        identityType {\\r\\n          id\\r\\n          name\\r\\n          code\\r\\n          description\\r\\n        }\\r\\n      }\\r\\n      ciudadPlaca {\\r\\n        id\\r\\n        name\\r\\n        name2\\r\\n        description\\r\\n        cityCode\\r\\n      }\\r\\n      version {\\r\\n        id\\r\\n        referenciaUno\\r\\n        referenciaDos\\r\\n        referenciaTres\\r\\n        cilindraje\\r\\n        peso\\r\\n        potencia\\r\\n        capacidadPasajeros\\r\\n        valor\\r\\n        puertas\\r\\n        tipoCaja\\r\\n        combustible\\r\\n        transmision\\r\\n        carLine {\\r\\n          id\\r\\n          brand {\\r\\n              id\\r\\n              name\\r\\n              description\\r\\n          }\\r\\n          name\\r\\n          description\\r\\n        }\\r\\n      }\\r\\n    }\\r\\n  }","variables":{}}';

    $response = json_decode(connectionCURL($cadena_json), true);
    if ($response.data == null){
        $return = $response["errors"];
    }else{
        $return = $response["data"]["createRetoma"]["id"];
    }
    wp_send_json( $return );
}
add_action("wp_ajax_crearRetomaASC", "crearRetomaASC");
add_action("wp_ajax_nopriv_crearRetomaASC", "crearRetomaASC");

function connectionCURL($cadena_json){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://d5gjkee6wnaxxdoxxlptnn6egq.appsync-api.us-east-1.amazonaws.com/graphql",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $cadena_json,
    CURLOPT_HTTPHEADER => array(
        "X-API-Key: da2-7hjlvtyegnaxlf262uxec66ba4",
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function variablesS3ASC() {
    $return = array();

    $identityPoolId = 'us-east-1:50e8fa55-1d7d-4002-babb-fdd63bce6c61';
    $bucket = 'automagnocoresystemadda51f6d69440ba8be1d5061bf8160233-dev';
    $region = 'us-east-1'; // us-west-2, us-east-1, etc
    $acl = 'public-read'; // private, public-read, etc
    $fileNamePublic = UUID::v4();
    
    $return[] = array(
        'identityPoolId' => $identityPoolId,
        'region' => $region,
        'bucket' => $bucket,
        'key' => 'upload/carPhotos/retakes/' . $fileNamePublic,
        'acl' => $acl,
    );

    wp_send_json( $return );
}
add_action("wp_ajax_variablesS3ASC", "variablesS3ASC");
add_action("wp_ajax_nopriv_variablesS3ASC", "variablesS3ASC");

class UUID {
    public static function v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }
}
