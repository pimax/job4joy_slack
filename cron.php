<?php

echo "Start Bots:\n";

if ($handle = opendir(__DIR__.'/installed/'))
{
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle)))
    {
        if ($entry != "." && $entry != "..")
        {
            $team = str_replace(".php", "", $entry);

            if (!processExists('php '.$team))
            {
                echo "Start team ID: ".$team."\n\n";

                $result = "";
                exec("nohup /usr/bin/php /home/lucky/web/luckyfeed.co/public_html/apps/slack/index.php ".$team." > /dev/null 2>&1 & echo $!", $result);

                echo print_r($result)."\n\n";
            } else {
                echo "Team Bot with ID: ".$team. " already started. Skip.\n";
            }
        }
    }

    closedir($handle);
}

echo "Done!\n";


function processExists($processName)
{
    $exists = false;
    $result = array();

    exec("ps u | grep '".$processName."'", $result);
    if ((count($result) - 2) > 0)
    {
        $exists = true;
    }

    return $exists;
}