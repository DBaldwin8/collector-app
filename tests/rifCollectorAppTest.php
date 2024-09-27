declare(strict_types=1);

<?php

require_once 'rif-collector-app.php';

use PHPUnit\Framework\TestCase;

class rifCollectorAppTest extends TestCase {

    public function testPopulateTableSuccess(): void
    {
        $inputArray = [
            ['make' => 'MAKE',
            'model' => 'MODEL',
            'type' => 'TYPE',
            'color' => 'COLOR',
            'mags_owned' => 2,
            'power_source' => 'POWER SOURCE',
            'sites_visited' => 1,
            'purchase_date' => '2024-01-01']
            ];

        $expected = "<tr>".
            "<td class='entry make-entry'>MAKE</td>".
            "<td class='entry model-entry'>MODEL</td>".
            "<td class='entry type-entry'>TYPE</td>".
            "<td class='entry color-entry'>COLOR</td>".
            "<td class='entry mags-entry'>2</td>".
            "<td class='entry power-entry'>POWER SOURCE</td>".
            "<td class='entry sites-entry'>1</td>".
            "<td class='entry purchase-entry'>2024-01-01</td>".
            "</tr>";

        $actual = populateTable($inputArray);

        $this->assertEquals($expected, $actual);
    }

            // This is a failure test not a malformed test.
    public function testPopulateTableMalformed(): void
    {
        $input = 4;

        $this->expectException(TypeError::class);
        populateTable($input);
    }

    public function testValidateSanitizeEntrySuccess(): void {
        $inputtedArray =
            ['make' => 'MAKE',
            'model' => 'MODEL',
            'type' => 'TYPE',
            'color' => 'tan',
            'mags' => 2,
            'power' => 'POWER SOURCE',
            'sites' => 1,
            'purchased' => '2024-01-01'];

        $expected =
            $validatedSanitizedArr =
                ['make' => 'MAKE',
                'model' => 'MODEL',
                'type' => 'TYPE',
                'color' => 1,
                'mags' => '2',
                'power' => 'POWER SOURCE',
                'sites' => '1',
                'purchased' => '2024-01-01'];

        $actual = validateSanitizeEntry($inputtedArray, $validatedSanitizedArr, $message);

        $this->assertEquals($expected, $actual);
    }

    public function testValidateSanitizeEntryMalformed(): void {
        $input = 'oh no I am going to break it';

        $this->expectException(TypeError::class);
        populateTable($input);
    }

    /*
    public function testValidateSanitizeEntryMalformed(): void {
        $input = [
            ['make' => 'MAKE',
            'model' => 'MODEL',
            'type' => 'TYPE',
            'color' => 'tan',
            'mags' => 2,
            'power' => 'POWER SOURCE',
            'sites' => 1,
            'purchased' => '01-01-2024']
        ];

        $this->expectException(TypeError::class);
    }
    */

}