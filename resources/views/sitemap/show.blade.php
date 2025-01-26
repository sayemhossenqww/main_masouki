@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
@php echo '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>'; @endphp
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>https://the-bruvs.com/</loc>
        <lastmod>2021-04-30T06:35:38+00:00</lastmod>
        <changefreq>Always</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://the-bruvs.com/contact</loc>
        <lastmod>2021-04-30T06:35:38+00:00</lastmod>
        <changefreq>Always</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://the-bruvs.com/about</loc>
        <lastmod>2021-04-30T06:35:38+00:00</lastmod>
        <changefreq>Always</changefreq>
        <priority>1</priority>
    </url>


    @foreach ($items as $item)
        <url>
            <loc>{{ $item->url }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($item->updated_at)) }}</lastmod>
            <changefreq>Always</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>