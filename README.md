# HighLightPHP
HighLightPHP is a PHP class library that provides syntax highlighting for code snippets using the Highlight.js library.

## Installation
You can install HighLightPHP using Composer. Just run the following command:

  `composer require iamjohndev/highlight:dev-main`
  
#   Usage
```php
use iamjohndev\HighLightPHP;

$highlighter = new HighLightPHP();
$code = 'echo "Hello, world!";';
$language = 'php';
$style = 'github-dark';
$highlighted_code = $highlighter->highlightCode($code, $language, $style);

echo $highlighted_code;

// or 
$highlighted_code = $highlighter->highlightCode('<?php echo "hello highlight php"?> ', 'php', 'github-dark');

echo $highlighted_code;

```
