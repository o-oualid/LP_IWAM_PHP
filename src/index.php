<?php
echo "<ol>";
printDir();
echo "</ol>";
function printDir($str = "./")
{
    $cmd = shell_exec('ls -F ' . $str);
    foreach (str_getcsv($cmd, "\n") as $item) {
        if (str_ends_with($item, "/")) {
            echo "<li>" . substr($item, 0, -1);
            echo "<ul>";
            printDir($str . $item);
            echo "</ul></li>";
        } else if (str_ends_with($item, ".php*")) {
            $fileName = substr($item, 0, -1);
            $path = $str . $fileName;
            echo "<li><a href=$path> $fileName</a></li>";
        }

    }
}
