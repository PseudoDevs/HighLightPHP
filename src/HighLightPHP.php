<?php

namespace iamjohndev;

class HighLightPHP
{
    private $languages;
    private $theme;

    public function __construct($theme = 'monokai')
    {
        $this->languages = [
            'javascript', 'python', 'php', 'java', 'c', 'cpp', 'ruby', 'html', 'css'
        ];
        $this->theme = $theme;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    public function highlightCode($code, $language)
    {
        if (!in_array($language, $this->languages)) {
            throw new Exception("Language not supported!");
        }

        $html = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js/styles/' . $this->theme . '.min.css">';
        $html .= '<script src="https://cdn.jsdelivr.net/npm/highlight.js"></script>';
        $html .= '<script>hljs.highlightAll();</script>';
        $html .= '<pre><code class="' . $language . '">' . htmlspecialchars($code) . '</code></pre>';

        return $html;
    }
}
