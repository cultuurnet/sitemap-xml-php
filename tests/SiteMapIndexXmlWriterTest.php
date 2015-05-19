<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\Web\Url;

class SiteMapIndexXmlWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SiteMapIndexXmlWriter
     */
    protected $writer;

    public function setUp()
    {
        $this->writer = new SiteMapIndexXmlWriter();
    }

    /**
     * @test
     */
    public function it_writes_the_expected_xml()
    {
        $entries = [
            [
                'location' => Url::fromNative('http://cultuurnet.be/sitemap-foo.xml'),
                'lastModified' => null,
            ],
            [
                'location' => Url::fromNative('http://cultuurnet.be/sitemap-bar.xml'),
                'lastModified' => Date::fromNative('2015', 'May', '7'),
            ],
        ];

        $this->writer->open();

        foreach ($entries as $data) {
            $entry = new SiteMapXmlEntry($data['location']);

            if (!empty($data['lastModified'])) {
                $entry->setLastModified($data['lastModified']);
            }

            $this->writer->write($entry);
        }

        $this->writer->close();

        $expected = file_get_contents(__DIR__ . '/xml/sitemap-index.xml');
        $this->expectOutputString($expected);
    }
}
