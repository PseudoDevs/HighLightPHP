# HighLightPHP
HighLightPHP is a PHP class library that enables syntax highlighting for code snippets using the Highlight.js library directly in your PHP code.

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
In addition to supporting all types of themes and languages from the Highlight JS library, HighLightPHP offers a simple and convenient way to add syntax highlighting to your PHP projects. It allows you to easily load the necessary language and style files, combine them with the Highlight.js library, and execute code highlighting on your code snippets.

With HighLightPHP, you can highlight code snippets in various programming languages, including PHP, JavaScript, HTML, CSS, Python, Java, Ruby, and many more. You can also choose from a wide range of pre-built styles, such as Github, Solarized, Monokai, and many others.

By using HighLightPHP in your projects, you can improve the readability of your code snippets and make it easier for your users to understand the code.
