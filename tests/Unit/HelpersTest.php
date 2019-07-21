<?php

namespace Tests\Unit;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function test_it_can_get_a_gravatar_url_from_an_email_address()
    {
        $gravatarUrl = gravatar('arthur.dent@hhgttg.net');

        $this->assertEquals('https://www.gravatar.com/avatar/dfb966909d35b070bc5d5888d091f63f', $gravatarUrl);
    }

    public function test_it_can_convert_markdown_to_html()
    {
        $html = markdown("# Heading\nParagraph text.\n  - Bulleted list item");

        $this->assertEquals(
            "<h1>Heading</h1>\n<p>Paragraph text.</p>\n<ul>\n<li>Bulleted list item</li>\n</ul>",
            $html
        );
    }
}
