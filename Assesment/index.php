<?php
$length = 10;
$width = 5;

$area = $length * $width;
$perimeter = 2* ($length + $width);

echo "<h3> Task 1: Rectangle calculations:<br></h3>";
echo "Length: " . $length . "units<br>";
echo "width: " . $width . "units<br>";
echo "Area: " . $area . "square units<br>";
echo "Perimeter: " . $perimeter . "units<br>";
echo "<br>";

/*Vat calculate*/

$amount = 1000;
$vatRate = 0.15;

$vatAmount = $amount * $vatRate;
$totalAmount = $amount + $vatAmount;

echo "<h3> Task 2: Vat Calculations:</h3> ";
echo "Base Amount: $" . number_format($amount, 2) . "<br>";
echo "VAT Rate: " . ($vatRate * 100) . "%<br>";
echo "VAT Amount: $" . number_format($vatAmount, 2) . "<br>";
echo "Total Amount (including VAT): $" . number_format($totalAmount, 2) . "<br>";
echo "<br>";

// TASK 3: Odd or Even Check
echo "<h3>Task 3: Odd or Even Check: </h3>";
$number = 25;

if ($number % 2 == 0) {
    echo "The number $number is even.<br><br>";
} else {
    echo "The number $number is odd.";
}
echo"<br><br>";

// TASK 4: Largest of Three Numbers

echo " <h3>Task 4: Largest of Three Numbers:</h3> ";
$num1 = 45;
$num2 = 78;
$num3 = 32;

if ($num1 >= $num2 && $num1 >= $num3) {
    echo "The largest number is: $num1<br><br>";
} elseif ($num2 >= $num1 && $num2 >= $num3) {
    echo "The largest number is: $num2<br><br>";
} else {
    echo "The largest number is: $num3<br><br>";
}

// TASK 5: Odd Numbers (10 to 100)

echo "<h3>Task 5: Odd Numbers between 10 and 100:</h3>";
echo "<br>";

for ($i = 10; $i <= 100; $i++) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
}
echo "<br><br>";

// TASK 6: Search in Array

echo "<h3>Task 6: Search Element in Array:</h3> ";
echo"<br>";

// Define an array
$numbers = array(10, 20, 30, 40, 50, 60, 70);
$searchElement = 40;
$found = false;

echo "Array: ";
foreach ($numbers as $value) {
    echo $value . " ";
}
echo "<br>";

echo "Searching for element: $searchElement<br>";

// Search for the element
foreach ($numbers as $value) {
    if ($value == $searchElement) {
        $found = true;
        break;
    }
}

if ($found) {
    echo "Element $searchElement found in the array.<br>";
} else {
    echo "Element $searchElement not found in the array.<br>";
}
 echo "<br>";

// 7 no. task
// Star pattern
echo "<h3>Task 7: Patterns:</h3> ";
echo "<br>";
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}


// Number pattern

for ($i = 3; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}

// Alphabet pattern
$ch = 'A';

for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $ch . " ";
        $ch++;
    }
    echo "<br>";
}

?>