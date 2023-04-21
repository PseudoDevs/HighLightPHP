<?php

namespace iamjohndev;

class HighLightPHP
{
    const HIGHLIGHT_JS_VERSION = '11.7.0';
    const LANGUAGES_DIR = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/' . self::HIGHLIGHT_JS_VERSION . '/languages';
    const STYLES_DIR = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/' . self::HIGHLIGHT_JS_VERSION . '/styles';

    private $languages_dir;
    private $styles_dir;
    private $highlight_js;

    public function __construct()
    {
        $this->languages_dir = self::LANGUAGES_DIR;
        $this->styles_dir = self::STYLES_DIR;
        $this->highlight_js = '//cdnjs.cloudflare.com/ajax/libs/highlight.js/' . self::HIGHLIGHT_JS_VERSION . '/highlight.min.js';
    }

    public function highlightCode($code, $language, $style)
    {
        // Validate input
        if (empty($code) || empty($language) || empty($style)) {
            throw new InvalidArgumentException('Missing code, language, or style');
        }

        // Load language file
        try {
            $language_file = $this->languages_dir . '/' . $language . '.min.js';
            $language_content = file_get_contents($language_file);
        } catch (Exception $e) {
            throw new Exception('Error loading language file');
        }

        // Load style file
        try {
            $style_file = $this->styles_dir . '/' . $style . '.min.css';
            $style_content = file_get_contents($style_file);
        } catch (Exception $e) {
            throw new Exception('Error loading style file');
        }

        // Execute code highlighting
        $result = '<style>' . $style_content . '</style>';
        $result .= '<script src="' . $this->highlight_js . '"></script>';
        $result .= '<pre><code class="language-' . htmlspecialchars($language) . '">' . htmlspecialchars($code) . '</code></pre>';
        $result .= '<script>document.addEventListener("DOMContentLoaded", (event) => {
            document.querySelectorAll("pre code").forEach((el) => {
              hljs.highlightElement(el);
            });
          });</script>';

        return $result;
    }
}
