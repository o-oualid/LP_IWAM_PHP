<form method="get">
    <label>
        x:<input type="number" name="x">
    </label><br>
    <label>
        n:<input type="number" name="n">
    </label><br>
    <label>
        decimals:<input type="number" name="decimals">
    </label><br>
    <input type="submit" value="calculate">
</form>
<?php


function equation(float $x, float $n)
{
    $result = 0;
    $fact = 1;
    foreach (range(0, $n) as $i) {
        $fact *= $i == 0 ? 1 : $i;
        $result += (pow($x, 2 * $i + 1) / $fact);
    }
    return $result;
}

if (isset($_GET["x"]) && is_numeric($_GET["x"]) &&
    isset($_GET["n"]) && is_numeric($_GET["n"]) &&
    isset($_GET["decimals"]) && is_numeric($_GET["decimals"])) {
    echo number_format(equation($_GET["x"], $_GET["n"]), $_GET["decimals"]);
}