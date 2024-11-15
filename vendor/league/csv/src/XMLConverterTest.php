<?php

/**
 * League.Csv (https://csv.thephpleague.com)
 *
 * (c) Ignace Nyamagana Butera <nyamsprod@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace League\Csv;

use DOMDocument;
use DOMElement;
use DOMException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('converter')]
final class XMLConverterTest extends TestCase
{
    public function testToXML(): void
    {
        $csv = Reader::createFromPath(__DIR__.'/../test_files/prenoms.csv', 'r')
            ->setDelimiter(';')
            ->setHeaderOffset(0)
        ;

        $stmt = Statement::create()
            ->offset(3)
            ->limit(5)
        ;

        $records = $stmt->process($csv);

        $converter = XMLConverter::create()
            ->rootElement('csv')
            ->recordElement('record', 'offset')
            ->fieldElement('field', 'name')
        ;

        $dom = $converter->convert($records);
        $record_list = $dom->getElementsByTagName('record');

        /** @var DOMElement $record_node */
        $record_node = $record_list->item(0);

        $field_list = $dom->getElementsByTagName('field');

        /** @var DOMElement $field_node */
        $field_node = $field_list->item(0);

        /** @var DOMElement $baseTag */
        $baseTag = $dom->documentElement;

        self::assertSame('csv', $baseTag->tagName);
        self::assertEquals(5, $record_list->length);
        self::assertTrue($record_node->hasAttribute('offset'));
        self::assertEquals(20, $field_list->length);
        self::assertTrue($field_node->hasAttribute('name'));
    }

    public function testXmlElementTriggersException(): void
    {
        $this->expectException(DOMException::class);
        XMLConverter::create()
            ->recordElement('record', '')
            ->rootElement('   ');
    }

    public function testImport(): void
    {
        $csv = Reader::createFromPath(__DIR__.'/../test_files/prenoms.csv', 'r')
            ->setDelimiter(';')
            ->setHeaderOffset(0)
        ;

        $stmt = Statement::create()
            ->offset(3)
            ->limit(5)
        ;

        $records = $stmt->process($csv);

        $converter = XMLConverter::create()
            ->rootElement('csv')
            ->recordElement('record', 'offset')
            ->fieldElement('field', 'name')
        ;

        $doc = new DOMDocument('1.0');
        $element = $converter->import($records, $doc);

        self::assertCount(0, $doc->childNodes);
        self::assertCount(5, $element->childNodes);
    }
}
