declare(strict_types=1);

<?php

require_once 'paint-collector-app.php';

use PHPUnit\Framework\TestCase;

class paintCollectorAppTest extends TestCase {

    public function testPopulateTable(): void
    {
        $inputArray = [['brand' => 'BRAND', 'name'=> 'NAME','color'=> 'COLOR','base'=> 'BASE','quantity_left' => 100, 'purchase_date' =>'2024-01-01']];

        $expected = "<tr>".
            "<td>BRAND</td>".
            "<td>NAME</td>".
            "<td>COLOR</td>".
            "<td>BASE</td>".
            "<td>100</td>".
            "<td>2024-01-01</td>".
            "</tr>";

        $actual = populateTable($inputArray);

        $this->assertEquals($expected, $actual);
    }

    public function testPopulateTableMalformed(): void
    {
        $inputArray = [['brand' => 3, 'name'=> 4,'color'=> 5,'base'=> 6,'quantity_left' => 'i am a string', 'purchase_date' =>'i am not a date']];

        $this->expectException(TypeError::class);
        populateTable($inputArray);
    }
}