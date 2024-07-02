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

    public function parse(): string
    {
        foreach ($this->keywords as $keyword) {
            $this->content = preg_replace(
                "/\b($keyword)\b/i",
                "<a href='https://example.com/$1'>$1</a>",
                $this->content
            );
        }

        return $this->content;
    }
}
