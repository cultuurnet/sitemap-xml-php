<?php

namespace CultuurNet\SiteMapXml;

class SiteMapIndexXmlWriter extends SiteMapXmlWriter
{
    /**
     * {@inheritdoc}
     */
    public function open($uri = null)
    {
        $this->openWriter($uri);
        $this->openRootElement('sitemapindex');
    }

    /**
     * @inheritdoc
     */
    public function write(SiteMapXmlEntry $entry)
    {
        $this->writeElement('sitemap', $entry);
    }
}
