<?php

$actionType = htmlspecialchars($_GET["action"]);
$inputSecret = htmlspecialchars($_GET["secret"]);
$serverSecret = $_SERVER['SYNC_SECRET'];
$mysqlPassword = $_SERVER['POSDB_PASS'];

# set our Timezone for Slack message timestamp
date_default_timezone_set('Australia/Melbourne');
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

if($inputSecret != $serverSecret){
    die("Unauthorised access - please provide the secret");
}

if($actionType == "rebuild"){
        updateBuild();
}elseif($actionType == "updatedb"){
        updateDatabase();
}else{
        die("Invalid action parameter provided");
    }

Function updateBuild(){

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
        'sudo git submodule status'
    );

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

}

// after foreach is broken out of/finished, check if there is an error
if($code == 0){
    buildSuccess($msg);
}

Function updateDatabase(){

    chdir('/git-dir/scripts');
    $output = shell_exec('./update-db.sh cbvpos cbvposdev-db admin ' . $mysqlPassword);
    echo $output;

}

Function buildFailed($msg){

// create our error message
    $errMsg = "Oh no.. A build has failed on the Dev Server\n";
    $errMsg .= "*The build output until an error code was:*\n";
    $errMsg .= "```";
    $errMsg .= $msg;
    $errMsg .= "```\n";
    $errMsg .= "Build attempt occurred at `" . date('D d M Y h i A') . " (AEST)`";

    $slackContent = array (
        'text' => $errMsg,
        'channel' => 'CCVHHM9N2',
        'attachments' =>
        array (
        0 =>
        array (
            'fallback' => 'Attempt a manual rebuild via http://cbvpos.josh.tf:8081/deploy.php?secret=' . $serverSecret . '&action=rebuild',
            'actions' =>
            array (
            0 =>
            array (
                'type' => 'button',
                'text' => 'Attempt Rebuild 🤖',
                'url' => 'http://cbvpos.josh.tf:8081/deploy.php?secret=?secret=' . $serverSecret . '&action=rebuild',
            ),
            1 =>
            array (
                'type' => 'button',
                'text' => 'View random cat 🐱',
                'url' => 'http://random.cat/',
            ),
            ),
        ),
        ),
    );

    postSlack($slackContent); // post to slack via curl

};

Function buildSuccess(){

    // create our success message
    $successMsg = "A build has *successfully* taken place on the Dev Server\n";
    $successMsg .= "This rebuild took place at `" . date('D d M Y h i A') . " (AEST)`";

    $slackContent = array (
        'text' => $successMsg,
        'channel' => 'CCVHHM9N2',
        'attachments' =>
        array (
        0 =>
        array (
            'fallback' => 'Attempt a database rebuild via http://cbvpos.josh.tf:8081/deploy.php??secret=' . $serverSecret . '&action=updatedb',
            'actions' =>
            array (
            0 =>
            array (
                'type' => 'button',
                'text' => 'Rebuild Database ⚙️',
                'url' => 'http://cbvpos.josh.tf:8081/deploy.php?secret=' . $serverSecret . '&action=updatedb',
            ),
            ),
        ),
        ),
    );

    postSlack($slackContent); // post to slack via curl

};

Function postSlack($slackContent){

    $webhook = $_SERVER['SLACK_WEBHOOK'];

    define('SLACK_WEBHOOK', $webhook);
    $message = array('payload' => json_encode($slackContent));
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