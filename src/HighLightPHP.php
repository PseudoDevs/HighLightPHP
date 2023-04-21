<?php

namespace iamjohndev;

class HighLightPHP
{
    private $highlighter;

    public function __construct(HighlighterInterface $highlighter)
    {
        $this->highlighter = $highlighter;
    }

    /**
     * Highlights the provided code using the provided language and theme
     * @param string $code The code to highlight
     * @param string $language The language to use for highlighting
     * @param string $theme The theme to use for highlighting
     * @return string The highlighted code
     */
    public function highlight($code, $language = 'plaintext', $theme = 'github')
    {
        return $this->highlighter->highlight($code, $language, $theme);
    }
}

interface HighlighterInterface
{
    public function highlight($code, $language, $theme);
}

class HighlightJs implements HighlighterInterface
{
    private $languages;
    private $themes;

    public function __construct(SupportedLanguages $languages, SupportedThemes $themes, $pathToHighlightJsLibrary)
    {
        $this->languages = $languages;
        $this->themes = $themes;
        require_once $pathToHighlightJsLibrary;
        foreach ($languages->getLanguages() as $language) {
            require_once __DIR__ . '/lib/highlightjs/languages/' . $language . '.min.js';
        }
        foreach ($themes->getThemes() as $theme) {
            require_once __DIR__ . '/lib/styles/' . $theme . '.min.css';
        }
    }

    public function highlight($code, $language = 'plaintext', $theme = 'github')
    {
        $language = strtolower($language);
        $theme = strtolower($theme);
        if (!$this->languages->isSupported($language)) {
            $language = 'plaintext';
        }
        if (!$this->themes->isSupported($theme)) {
            $theme = 'github';
        }
        $highlighted = \Highlight\Highlighter::highlight($language, $code)->value;
        $theme_file = __DIR__ . '/lib/styles/' . $theme . '.min.css';
        $highlighted = '<link rel="stylesheet" href="' . $theme_file . '">' . $highlighted;
        return $highlighted;
    }
}

class SupportedLanguages
{
    private $languages = array(
        'bash',
        'c', 'c++', 'c#', 'css', 'dart', 'go', 'html', 'java', 'javascript',
        'json', 'kotlin', 'lua', 'markdown', 'nginx', 'objectivec', 'php',
        'python', 'ruby', 'rust', 'scss', 'shell', 'sql', 'swift', 'typescript',
        'xml', 'yaml',
    );
}

class SupportedThemes
{
    private $themes = array(
        'a11y-dark',
        'a11y-light',
        'agate',
        'an-old-hope',
        'androidstudio',
        'arduino-light',
        'arta',
        'ascetic',
        'atelier-cave-dark',
        'atelier-cave-light',
        'atelier-dune-dark',
        'atelier-dune-light',
        'atelier-estuary-dark',
        'atelier-estuary-light',
        'atelier-forest-dark',
        'atelier-forest-light',
        'atelier-heath-dark',
        'atelier-heath-light',
        'atelier-lakeside-dark',
        'atelier-lakeside-light',
        'atelier-plateau-dark',
        'atelier-plateau-light',
        'atelier-savanna-dark',
        'atelier-savanna-light',
        'atelier-seaside-dark',
        'atelier-seaside-light',
        'atelier-sulphurpool-dark',
        'atelier-sulphurpool-light',
        'atom-one-dark-reasonable',
        'atom-one-dark',
        'atom-one-light',
        'brown-paper',
        'codepen-embed',
        'color-brewer',
        'darcula',
        'dark',
        'default-override',
        'docco',
        'dracula',
        'far',
        'foundation',
        'github-dark-dimmed',
        'github-dark',
        'github',
        'gml',
        'gradient-dark',
        'grayscale',
        'gruvbox-dark',
        'gruvbox-light',
        'hopscotch',
        'hybrid',
        'idea',
        'ir-black',
        'isbl-editor-dark',
        'isbl-editor-light',
        'kimbie.dark',
        'kimbie.light',
        'lightfair',
        'lioshi',
        'magula',
        'mono-blue',
        'monokai-sublime',
        'monokai',
        'night-owl',
        'nnfx-dark',
        'nnfx-light',
        'nord',
        'obsidian',
        'ocean',
        'paraiso-dark',
        'paraiso-light',
        'pojoaque',
        'purebasic',
        'qtcreator_dark',
        'qtcreator_light',
        'railscasts',
        'rainbow',
        'routeros',
        'school-book',
        'shades-of-purple',
        'solarized-dark',
        'solarized-light',
        'srcery',
        'stackoverflow-dark',
        'stackoverflow-light',
        'sunburst',
        'tomorrow-night-blue',
        'tomorrow-night-bright',
        'tomorrow-night-eighties',
        'tomorrow-night',
        'tomorrow',
        'vs',
        'vs2015',
        'xcode',
        'xt256',
        'zenburn',
    );

    public function isSupported($theme)
    {
        return in_array(strtolower($theme), $this->themes);
    }

    public function getThemes()
    {
        return $this->themes;
    }
}