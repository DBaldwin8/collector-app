declare(strict_types=1);

<?php

require_once 'rif-collector-app.php';

use PHPUnit\Framework\TestCase;

class rifCollectorAppTest extends TestCase {

    public function testPopulateTable(): void
    {
        $inputArray = [['make' => 'MAKE',
            'model'=> 'MODEL',
            'type'=> 'TYPE',
            'color' => 'COLOR',
            'power_source' => 'POWER SOURCE',
            'sites_visited' => 1,
            'purchased_date' => '2024-01-01']];

        $expected = "<tr>".
            "<td class='entry'>MAKE</td>".
            "<td class='entry'>MODEL</td>".
            "<td class='entry'>TYPE</td>".
            "<td class='entry'>COLOR</td>".
            "<td class='entry'>POWER SOURCE</td>".
            "<td class='entry'>1</td>".
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