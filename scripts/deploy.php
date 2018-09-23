<?php

$inputSecret = htmlspecialchars($_GET["secret"]);
$serverSecret = $_SERVER['SYNC_SECRET'];

if($inputSecret != $serverSecret){
    //die("Unauthorised access - please provide the secret");
}

# set our Timezone for Slack message timestamp
date_default_timezone_set('Australia/Melbourne');

# set our working directory
chdir('/git-dir');

$exec = array(
    'echo $PWD',
    'whoami',
    'sudo git reset --hard HEAD',
    'sudo git pull',
    'sudo git status',
    'sudo git submodule sync',
    'sudo git submodule update',
    'sudo git submodule status',
);
?>

<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Github Sync Script [josh-tf]</title>
</head>

<body style="background: #333; color: #FFFFFF;">
    <pre>

##############################
#                            #
#  Github Sync Script v1.1   #
#    github.com/josh-tf      #
#                            #
##############################

<?php

$output = null;
foreach ($exec as $cmd) {

    echo "<span style=\"color: #ff3333;\">\$</span> <span style=\"color: #ff8686;\">{$cmd}\n</span>";
    $result = system($cmd, $code);
    $termStdOut .= htmlentities(trim($result)) . "\n";

    if($code != 0){
        buildFailed($termStdOut);
        break;
    }

}

// after foreach is broken out of/finished, check if there is an error
if($code == 0){
    buildSuccess($msg);
}

Function buildFailed($msg){

// create our error message
    $errMsg = "Oh no.. A build has failed on the Dev Server\n";
    $errMsg .= "*The build output until an error code was:*\n";
    $errMsg .= "```";
    $errMsg .= $msg;
    $errMsg .= "```\n";
    $errMsg .= "Build attempt occurred at `" . date('D d M Y h i A') . " (AEST)`";

    postSlack($errMsg); // post to slack via curl

};

Function buildSuccess(){

    // create our success message
    $successMsg = "A build has *successfully* taken place on the Dev Server\n";
    $successMsg .= "This rebuild took place at `" . date('D d M Y h i A') . " (AEST)`";

    postSlack($successMsg); // post to slack via curl

};

Function postSlack($msg){

    $webhook = $_SERVER['SLACK_WEBHOOK'];

    define('SLACK_WEBHOOK', $webhook);
    $message = array('payload' => json_encode(array('text' => $msg)));
    $c = curl_init(SLACK_WEBHOOK);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $message);
    curl_exec($c);
    curl_close($c);

};

?>

</pre>
</body>

</html>