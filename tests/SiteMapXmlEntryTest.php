<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Web\Url;

class SiteMapXmlEntryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_returns_the_stored_data()
    {
        $locationString = 'http://cultuurnet.be';
        $location = Url::fromNative($locationString);
        $entry = new SiteMapXmlEntry($location);

        $this->assertEquals($location, $entry->getLocation());
        $this->assertEquals($locationString, (string) $entry->getLocation());

        $this->assertNull($entry->getLastModified());

        $lastModifiedString = '2015-5-23';
        $nativeDateTime = new \DateTime($lastModifiedString);
        $lastModified = Date::fromNativeDateTime($nativeDateTime);
        $entry->setLastModified($lastModified);

        $this->assertEquals($lastModified, $entry->getLastModified());
        $this->assertEquals($lastModifiedString, (string) $entry->getLastModified());
    }

    /**
     * @test
     */
    public function it_validates_the_last_modified_date()
    {
        $locationString = 'http://cultuurnet.be';
        $location = Url::fromNative($locationString);
        $entry = new SiteMapXmlEntry($location);

        $nativeDateTime = new \DateTime('2015-6-7');
        $validDate = Date::fromNativeDateTime($nativeDateTime);
        $entry->setLastModified($validDate);

        $nativeDateTime = new \DateTime('2015-6-7');
        $validDateTime = DateTime::fromNativeDateTime($nativeDateTime);
        $entry->setLastModified($validDateTime);

        $invalidDate = new \stdClass();
        $this->setExpectedException('InvalidArgumentException');
        $entry->setLastModified($invalidDate);
    }
}
