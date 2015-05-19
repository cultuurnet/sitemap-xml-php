<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\Web\Url;

class SiteMapUrlSetXmlWriterTest extends SiteMapXmlWriterTest
{
    /**
     * @var SiteMapUrlSetXmlWriter
     */
    protected $writer;

    public function setUp()
    {
        $this->writer = new SiteMapUrlSetXmlWriter();

        $this->entries = [];

        $location = Url::fromNative('http://cultuurnet.be/foo.html');
        $entry = new SiteMapXmlEntry($location);
        $this->entries[] = $entry;

        $location = Url::fromNative('http://cultuurnet.be/bar.html');
        $lastModified = Date::fromNative('2015', 'May', '7');
        $entry = new SiteMapXmlEntry($location);
        $entry->setLastModified($lastModified);
        $this->entries[] = $entry;
    }

    /**
     * @test
     */
    public function it_writes_the_expected_xml()
    {
        $this->writeEntries($this->entries);

        $expected = file_get_contents(__DIR__ . '/xml/sitemap.xml');
        $this->expectOutputString($expected);
    }

    /**
     * @test
     */
    public function it_can_write_the_xml_to_a_file()
    {
        $uri = tempnam(sys_get_temp_dir(), 'sitemap');
        $this->writeEntries($this->entries, $uri);

        $expected = file_get_contents(__DIR__ . '/xml/sitemap.xml');
        $actual = file_get_contents($uri);
        $this->assertEquals($expected, $actual);
    }
}
