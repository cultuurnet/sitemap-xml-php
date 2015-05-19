<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\Web\Url;

class SiteMapIndexXmlWriterTest extends SiteMapXmlWriterTest
{
    public function setUp()
    {
        $this->writer = new SiteMapIndexXmlWriter();
    }

    /**
     * @test
     */
    public function it_writes_the_expected_xml()
    {
        $entries = [];

        $location = Url::fromNative('http://cultuurnet.be/sitemap-foo.xml');
        $entry = new SiteMapXmlEntry($location);
        $entries[] = $entry;

        $location = Url::fromNative('http://cultuurnet.be/sitemap-bar.xml');
        $lastModified = Date::fromNative('2015', 'May', '7');
        $entry = new SiteMapXmlEntry($location);
        $entry->setLastModified($lastModified);
        $entries[] = $entry;

        $this->writeEntries($entries);

        $expected = file_get_contents(__DIR__ . '/xml/sitemap-index.xml');
        $this->expectOutputString($expected);
    }
}
