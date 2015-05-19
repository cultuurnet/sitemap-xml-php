<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\Web\Url;

class SiteMapUrlSetXmlWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SiteMapUrlSetXmlWriter
     */
    protected $writer;

    public function setUp()
    {
        $this->writer = new SiteMapUrlSetXmlWriter();
    }

    /**
     * @test
     */
    public function it_writes_the_expected_xml()
    {
        $entries = [
            [
                'location' => Url::fromNative('http://cultuurnet.be/foo.html'),
                'lastModified' => null,
            ],
            [
                'location' => Url::fromNative('http://cultuurnet.be/bar.html'),
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

        $expected = file_get_contents(__DIR__ . '/xml/sitemap.xml');
        $this->expectOutputString($expected);
    }
}
