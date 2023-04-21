<?php

namespace iamjohndev;

class HighLightPHP
{
    private $languages_dir;
    private $styles_dir;
    private $highlight_js;

    public function __construct()
    {
        $this->languages_dir = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages';
        $this->styles_dir = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles';
    }

    public function highlightCode($code, $language, $style)
    {
        // Load language file
        $language_file = $this->languages_dir . '/' . $language . '.min.js';
        $language_content = file_get_contents($language_file);

        // Load style file
        $style_file = $this->styles_dir . '/' . $style . '.min.css';
        $style_content = file_get_contents($style_file);

        // Execute code highlighting
        $result = '<style>' . $style_content . '</style>';
        $result .= '<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>';
        $result .= '<pre><code class="language-' . $language . '">' . htmlentities($code) . '</code></pre>';
        $result .= '<script>document.addEventListener("DOMContentLoaded", (event) => {
            document.querySelectorAll("pre code").forEach((el) => {
              hljs.highlightElement(el);
            });
          });</script>';

        return $result;
    }
}