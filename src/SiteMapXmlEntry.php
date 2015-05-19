<?php

namespace CultuurNet\SiteMapXml;

use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\DateTime;
use ValueObjects\Web\Url;

class SiteMapXmlEntry
{
    /**
     * TODO: Provide properties for change frequency and priority when necessary.
     */

    /**
     * @var Url
     */
    protected $location;

    /**
     * @var Date|DateTime
     */
    protected $lastModified = null;

    /**
     * @param Url $location
     */
    public function __construct(Url $location)
    {
        $this->setLocation($location);
    }

    /**
     * @param Url $location
     *
     * @throws \InvalidArgumentException
     *   When location is not a string.
     */
    public function setLocation(Url $location)
    {
        $this->location = $location;
    }

    /**
     * @return Url
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Date|DateTime $lastModified
     *
     * @throws \InvalidArgumentException
     *   When last-modified is not a Date or DateTime value object.
     */
    public function setLastModified($lastModified)
    {
        if (!($lastModified instanceof Date) && !($lastModified instanceof DateTime)) {
            throw new \InvalidArgumentException('Last modified date should be of type Date or DateTime.');
        }
        $this->lastModified = $lastModified;
    }

    /**
     * @return Date|DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }
}
