<?php
require_once "vendor/autoload.php";

use Slim\App;
use Slim\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new App(new Container([
    "settings" => [
        "displayErrorDetails" => true
    ]
]));

//rota /webservice/validar/numericos
$app->post("/webservice/validar/numericos", function($req, $res, $args){
    
    $valores = json_decode($req->getBody()->getContents(), true);
    $resultado = array();

    foreach ($valores as $valor) {
        if(is_numeric($valor) && !is_string($valor)){
            array_push($resultado, $valor);
        }
    }    
        var_dump($resultado);
});



//rota /webservice/validar/maior

/*valores para teste
{
"v1": 7,
"v2": 8,
"v3": 3,
"v4": 4,
"v5": 5,
"v6": 2
}
*/ 
$app->post("/webservice/validar/maior", function($req, $res, $args){
    
    $valores = json_decode($req->getBody()->getContents(), true);
    $resultado = array();

    foreach ($valores as $valor) {      
            array_push($resultado, $valor);
    }    
        echo "maior: " . max($resultado);
});



//rota /webservice/validar/par-ou-impar/numero
$app->get("/webservice/validar/par-ou-impar/{numero}", function($req, $res, $args){
    
    $numero = $args['numero'] % 2 == 0 ? "Par" : "Impar";

    return $res->withJson([
        "Valor informado" => $args['numero'],
        "resultado" => $numero
    ]);
});



//rota /webservice/testar/tipo-variavel

/*valores para teste
{
"v1": "7",
"v2": true,
"v3": 3,
"v4": false,
"v5": 5,
"v6": 2.2
}
*/
$app->post("/webservice/testar/tipo-variavel", function($req, $res, $args){
    
    $valores = json_decode($req->getBody()->getContents(), true);
    $resultado = array();

    foreach ($valores as $valor) {
            array_push($resultado, gettype($valor));
    }    
        var_dump($resultado);
});


$app->run();
