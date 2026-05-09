<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversFunction('gravatar'), CoversFunction('markdown'), CoversFunction('markdownInline')]
class HelpersTest extends TestCase
{
    #[Test]
    public function it_can_get_a_gravatar_url_from_an_email_address(): void
    {
        $gravatarUrl = gravatar('arthur.dent@hhgttg.net');

        $this->assertEquals('https://www.gravatar.com/avatar/dfb966909d35b070bc5d5888d091f63f', $gravatarUrl);
    }

    #[Test]
    public function it_can_convert_markdown_to_html(): void
    {
        $html = markdown("# Heading\nParagraph text.\n  - Bulleted list item");

        $this->assertEquals(
            "<article class=\"markdown\" v-pre><h1>Heading</h1>\n<p>Paragraph text.</p>\n<ul>\n<li>Bulleted list item</li>\n</ul></article>",
            $html
        );
    }

    #[Test]
    public function it_can_convert_markdown_to_inline_html(): void
    {
        $html = markdownInline('Some `inline` text');

        $this->assertEquals(
            '<span class="markdown" v-pre>Some <code>inline</code> text</span>',
            $html
        );
    }
}
