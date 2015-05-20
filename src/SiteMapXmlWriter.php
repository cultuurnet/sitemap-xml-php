<?php

namespace CultuurNet\SiteMapXml;

abstract class SiteMapXmlWriter implements SiteMapXmlWriterInterface
{
    /**
     * XML Version.
     */
    const XML_VERSION = '1.0';

    /**
     * XML namespace / schema.
     */
    const XML_NAMESPACE = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * Encoding of the XML file/output.
     */
    const ENCODING = 'UTF-8';

    /**
     * @var \XMLWriter
     */
    protected $writer = null;

    /**
     * @inheritdoc
     *
     * @throws \InvalidArgumentException
     *   When the provided URI is not a string.
     *
     * @throws \LogicException
     *   When the current writer is still open.
     */
    protected function openWriter($uri = null)
    {
        if (is_null($uri)) {
            $uri = 'php://output';
        }

        if (!is_string($uri)) {
            throw new \InvalidArgumentException('URI should be of type string.');
        }

        if (!is_null($this->writer)) {
            throw new \LogicException("Current writer is not yet closed.");
        }

        $this->writer = new \XMLWriter();
        $this->writer->openUri($uri);
        $this->writer->startDocument(self::XML_VERSION, self::ENCODING);

        $this->writer->setIndent(true);
    }

    /**
     * Opens the root element of the sitemap XML.
     *
     * @param string $tagName
     */
    protected function openRootElement($tagName)
    {
        $this->writer->startElement($tagName);
        $this->writer->writeAttribute('xmlns', self::XML_NAMESPACE);
    }

    /**
     * @param string $tagName
     * @param SiteMapXmlEntry $entry
     */
    protected function writeElement($tagName, SiteMapXmlEntry $entry)
    {
        $this->writer->startElement($tagName);
        $this->writer->writeElement('loc', (string) $entry->getLocation());

        $lastModified = $entry->getLastModified();
        if (!empty($lastModified)) {
            $this->writer->writeElement('lastmod', (string) $lastModified);
        }

        $this->writer->endElement();
    }

    /**
     * Closes the root element and the current writer.
     */
    public function close()
    {
        $this->closeRootElement();
        $this->closeWriter();
    }

    /**
     * Closes the root element of the sitemap XML.
     */
    protected function closeRootElement()
    {
        $this->writer->endElement();
    }

    /**
     * @inheritdoc
     */
    protected function closeWriter()
    {
        if (!is_null($this->writer)) {
            $this->writer->endDocument();
            $this->writer->flush();
            $this->writer = null;
        }
    }
}
