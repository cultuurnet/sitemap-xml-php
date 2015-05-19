<?php

namespace CultuurNet\SiteMapXml;

abstract class SiteMapXmlWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SiteMapIndexXmlWriter
     */
    protected $writer;

    /**
     * @param SiteMapXmlEntry[] $entries
     *   Array of entries to write to XML.
     * @param string $uri
     *   URI to write the XML to. Use null or php://output to print the XML.
     */
    protected function writeEntries($entries, $uri = null)
    {
        $this->writer->open($uri);

        foreach ($entries as $entry) {
            $this->writer->write($entry);
        }

        $this->writer->close();
    }
}
