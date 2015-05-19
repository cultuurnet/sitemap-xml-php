<?php

namespace CultuurNet\SiteMapXml;

class SiteMapUrlSetXmlWriter extends SiteMapXmlWriter
{
    /**
     * {@inheritdoc}
     */
    public function open($uri = null)
    {
        $this->openWriter($uri);
        $this->openRootElement('urlset');
    }

    /**
     * @inheritdoc
     */
    public function write(SiteMapXmlEntry $entry)
    {
        $this->writeElement('url', $entry);
    }
}
