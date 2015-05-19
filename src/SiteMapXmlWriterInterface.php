<?php

namespace CultuurNet\SiteMapXml;

interface SiteMapXmlWriterInterface
{
    /**
     * Opens a new writer.
     *
     * @param string $uri
     *   URI to write the XML to. Use php://output to print the XML.
     *
     * @return void
     */
    public function open($uri = null);

    /**
     * Writes data to the XML file.
     *
     * @param SiteMapXmlEntry $entry
     *   Element to write to the XML.
     *
     * @return void
     */
    public function write(SiteMapXmlEntry $element);

    /**
     * Closes the current writer.
     *
     * @return void
     */
    public function close();
}
