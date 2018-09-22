<?php

$inputSecret = htmlspecialchars($_GET["secret"]);
$serverSecret = $_SERVER['SYNC_SECRET'];

if($inputSecret != $serverSecret){
    die("Unauthorised access - please provide the secret");
}

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

$output = null;
foreach ($exec as $cmd) {
    $result = shell_exec($cmd);
    $term .= "<span style=\"color: #ff3333;\">\$</span> <span style=\"color: #ff8686;\">{$cmd}\n</span>";
    $term .= htmlentities(trim($result)) . "\n";
}

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
#  Github Sync Script v1.0   #
#    github.com/josh-tf      #
#                            #
##############################

<?php

  echo $term;

$webhook = $_SERVER['SLACK_WEBHOOK'];

  define('SLACK_WEBHOOK', $webhook);
  $message = array('payload' => json_encode(array('text' => 'A rebuild has successfully been completed on the development build server')));
  $c = curl_init(SLACK_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
  curl_exec($c);
  curl_close($c);


 ?>

</pre>
</body>

</html>