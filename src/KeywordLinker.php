<?php

namespace The3LabsTeam\KeywordLinker;

class KeywordLinker
{
    public string $content;

    public array $keywords;

    public function __construct(string $content, array $keywords)
    {
        $this->content = $content;
        $this->keywords = $keywords;
    }

    public static function parse(string $content, array $keywords): string
    {
        return (new self($content, $keywords))->parseContent();
    }

    public function parseContent(): string
    {
        foreach ($this->keywords as $keyword => $link) {
            $this->content = preg_replace(
                "/\b($keyword)\b(?![^<]*>|[^<>]*<\/a>)/i",
                "<a href='$link'>$1</a>",
                $this->content
            );
        }

        return $this->content;
    }
}
