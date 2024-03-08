<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if ($data !== null) {
        $compteur = intval($data['compteur']);
        $compteur++;
        $response = array("compteur" => $compteur, "echo" => ["Le compteur a été incrémenté avec succès en PHP"]);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Le contenu de la requête n'est pas au format JSON valide."));
    }
    
} else {
    echo "Hello World\n";
}
?>
