
<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20

** Based of Justin Stolpe's Youtube-video https://www.youtube.com/watch?v=ABmyXZoq_9Y.

** functions.php consists of functions to receive a OAuth-key from Blizzard's API.
** Read more: https://develop.battle.net/documentation/guides/using-oauth.
*/
include 'defines.php';

// Opens a PDO-connection using credentials from defines.php
function getDatabaseConnection(){
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        return $conn;
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
}

// updates the table wow_game_data_api in the database with accesstoken
function updateAccessToken( $accessToken ) {
    $databaseConnection = getDatabaseConnection();
    $statement = $databaseConnection->prepare('
        UPDATE
            wow_game_data_api
        SET 
            value = :value 
        WHERE 
            id = :id
    ');

    $params = array( 
        'id' => 'access_token',
        'value' => $accessToken
    );

    $statement->execute($params);
}

/*
** Generates the access-token according to Blizzard's guide https://develop.battle.net/documentation/guides/using-oauth/client-credentials-flow.
** by utilizing curl.
*/ 
function generateAccessToken(){
    $params = array(
        'grant_type' => 'client_credentials'
    );

    $tokenUri = 'https://eu.battle.net/oauth/token';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_USERPWD, CLIENT_ID . ":" . CLIENT_SECRET);
    curl_setopt($ch, CURLOPT_URL, $tokenUri);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $accessTokenResponse = json_Decode($response, true);

    if(isset($accessTokenResponse['access_token'])){
        $status = 'ok';
        $message = 'New access token save and ready for use.';

        updateAccessToken($accessTokenResponse['access_token']);
    }
    else{
        $status = 'fail';
        $message = 'Something went wrong trying to get an access token.';
    }

    return array(
        'status' => $status,
        'message' => $message,
        'raw_response' => $accessTokenResponse
    );
}
?>