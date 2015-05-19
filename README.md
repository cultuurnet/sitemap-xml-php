# sitemap-xml-php
PHP library for writing sitemap XML conform with the [sitemaps.org schema](http://www.sitemaps.org/protocol.html).

# Usage

Note that the SiteMapXmlWriter classes will always write a new sitemap. It's not possible to edit or delete entries from an existing sitemap.

## Urlset

[http://www.sitemaps.org/protocol.html#urlsetdef](http://www.sitemaps.org/protocol.html#urlsetdef)

**Example**

	// Create a new urlset writer.
	$writer = new SiteMapUrlSetXmlWriter();
	$writer->open('your/path/to/file.xml');
	
	// Create a new entry object.
	$entryLocation = Url::fromNative('http://foo.bar/file.html');
	$entryModified = Date::fromNative(2015-05-19);
	
	$entry = new SiteMapXmlEntry($entryLocation);
	$entry->setLastModified($entryModified);
	
	// Write the entry object.
	$writer->write($entry);
	
	// Close the writer. (Will save the XML.)
	$writer->close();
	
**Result**

	<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	 <url>
	  <loc>http://foo.bar/file.html</loc>
	  <lastmod>2015-5-19</lastmod>
	 </url>
	</urlset>
	
## Sitemap index

[http://www.sitemaps.org/protocol.html#sitemapIndex_sitemap](http://www.sitemaps.org/protocol.html#sitemapIndex_sitemap)

**Example**

	// Create a new sitemap index writer.
	$writer = new SiteMapIndexXmlWriter();
	$writer->open('your/path/to/file.xml');
	
	// Create a new entry object.
	$entryLocation = Url::fromNative('http://foo.bar/sitemap-file.xml');
	$entryModified = Date::fromNative(2015-05-19);
	
	$entry = new SiteMapXmlEntry($entryLocation);
	$entry->setLastModified($entryModified);
	
	// Write the entry object.
	$writer->write($entry);
	
	// Close the writer. (Will save the XML.)
	$writer->close();
	
**Result**

	<?xml version="1.0" encoding="UTF-8"?>
	<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	 <sitemap>
	  <loc>http://foo.bar/sitemap-file.xml</loc>
	  <lastmod>2015-5-19</lastmod>
	 </sitemap>
	</sitemapindex>
	
## Writing XML to output / memory

Passing `null`, or `php://output` to the `open()` method of any `SiteMapXmlWriter` object will write the XML to the output stream.

Passing `php://memory` will write the XML to the memory stream. 


	
	


