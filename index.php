<?php
declare(strict_types=1);
function increment(int $a): int
{
    return ++$a;
}

echo increment(2);
$a = 5;
$b = 6;

trait TTrait
{
    function Tfun()
    {
        echo "Hello trait";
    }
}

class Tex
{
    use TTrait;
}

class Tex1
{
    use TTrait;
}

$obj1 = new Tex();
$obj1->Tfun();

$obj2 = new Tex1();
$obj2->Tfun();

$obj = new class ($a, $b) {
    private int $x;
    private int $y;

    public function __construct($a, $b)
    {
        $this->x = $a;
        $this->y = $b;
    }

    public function sum(): int
    {
        return $this->x + $this->y;
    }
};
echo $obj->sum();

echo "<h2>";
function intrange(int $start, int $end): Generator
{
   for ($i=$start;$i<$end;$i++)
    yield $i++;

}

foreach (intrange(1,10) as $x)
    echo ($x);
echo "</h2>";
echo "<h2>";
function funx(iterable $itt){
    foreach($itt as $x)
        echo $x." ";
}
funx(intrange(1,100));
echo "</h2>";
echo "<br>";
function func(){

    $arr = array('num' => 6, 'book' => 'Polyanna', 'name' => 'Fred', 'age' => 8);
    foreach($arr as $key=>$value)
        echo $key." ".$value."<br>";
}

func();

$arr=["oualid","hamza","mouad","ahmed"];
function enumerate(array $arr,int $start=0): Iterator
{
    for($i=0;$i<count($arr);$i++)
        yield $i => $arr[$i];
}
echo "<br>";

foreach(enumerate($arr) as $number => $name)
    echo $number.": ".$name."<br>";

?>

<br>
<br>
<?php

class User
{
    public function __call($name, $arguments)
    {
        echo $name . ': ' . implode(', ', $arguments) . PHP_EOL;
    }

public function bonus($amount)
{
    echo 'bonus: ' . $amount . PHP_EOL;
}
}

$user = new User();
$user->hello('John', 34);//__call=>hello:
$user->bonus(560.00);
$user->salary(4200.00);

?>
