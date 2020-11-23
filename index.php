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
    
    $numeros = array();

    foreach ($req->getParsedBody() as $key => $value) {
        if(is_numeric($value) && !is_string($value)){
            array_push($numeros, $value);
        }
    }    
        var_dump($numeros);
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
    
    $numeros = array();

    foreach ($req->getParsedBody() as $key => $value) {      
            array_push($numeros, $value);
    }    
        echo "maior: " . max($numeros);
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
    
    $numeros = array();

    foreach ($req->getParsedBody() as $key => $value) {
            array_push($numeros, gettype($value));
    }    
        var_dump($numeros);
});


$app->run();
