<html><head><title>Sample Dashboard</title></head>
<body>
<h3>Press a button:<br />
<button onclick="window.location='dashboard.php?command=genpwd'">Generate Pwd</button>
<button onclick="window.location='dashboard.php?command=uname'">Kernel Name</button>
<button onclick="window.location='dashboard.php?command=ip'">IP Address</button>
<button onclick="window.location='dashboard.php?command=listen'">Port listening</button>
<button onclick="window.location='dashboard.php?command=weather&option=Dallas'">Weather</button>
</h3>
<?php

$command = $_GET['command'];
$option = $_GET['option'];

switch ($command)
{
    case "ip":
        echo shell_exec("wget http://ipinfo.io/ip -qO -");
        break;
    case "genpwd":
        echo shell_exec("(haveged -n 1000 -f - 2>/dev/null | tr -cd '[:graph:]' | fold -w 16 && echo ) | head -1");
        break;
    case "uname":
        echo shell_exec("uname -a");
        break;
    case "listen":
        echo nl2br(shell_exec("netstat -tlunap | grep LISTEN"));
        break;
    case "weather":
        echo file_get_contents("http://wttr.in/$option");
        break;
    default:
        echo "<h1>Press a button!</h1>";
}

?>
</body></html>
