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
    }

    /**
     * @test
     */
    public function it_writes_the_expected_xml()
    {
        $entries = [];

        $location = Url::fromNative('http://cultuurnet.be/foo.html');
        $entry = new SiteMapXmlEntry($location);
        $entries[] = $entry;

        $location = Url::fromNative('http://cultuurnet.be/bar.html');
        $lastModified = Date::fromNative('2015', 'May', '7');
        $entry = new SiteMapXmlEntry($location);
        $entry->setLastModified($lastModified);
        $entries[] = $entry;

        $this->writeEntries($entries);

        $expected = file_get_contents(__DIR__ . '/xml/sitemap.xml');
        $this->expectOutputString($expected);
    }
}
