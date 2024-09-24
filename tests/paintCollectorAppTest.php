declare(strict_types=1);

<?php

require_once 'paint-collector-app.php';

use PHPUnit\Framework\TestCase;

class paintCollectorAppTest extends TestCase {

    public function testPopulateTable(): void
    {
        $inputArray = [['brand' => 'BRAND',
            'name'=> 'NAME',
            'color'=> 'COLOR',
            'base'=> 'BASE',
            'quantity_left' => 100,
            'purchase_date' =>'2024-01-01']];

        $expected = "<tr>".
            "<td class='entry'>BRAND</td>".
            "<td class='entry'>NAME</td>".
            "<td class='entry'>COLOR</td>".
            "<td class='entry'>BASE</td>".
            "<td class='entry'>0.1</td>".
            "<td class='entry'>2024-01-01</td>".
            "</tr>";

        $actual = populateTable($inputArray);

        $this->assertEquals($expected, $actual);
    }

    public function testPopulateTableMalformed(): void
    {
        $input = 4;

        $this->expectException(TypeError::class);
        populateTable($input);
    }
}