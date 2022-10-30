import Prism from 'prismjs';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-ini';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-php-extras';
import 'prismjs/components/prism-shell-session';
import 'prismjs/plugins/show-language/prism-show-language';
import 'prismjs/plugins/normalize-whitespace/prism-normalize-whitespace';

export function prismInit() {
    Prism.plugins.NormalizeWhitespace.setDefaults({
        'remove-trailing': true,
        'remove-indent': true,
        'left-trim': true,
        'right-trim': true
    });

    Prism.highlightAll();
}

