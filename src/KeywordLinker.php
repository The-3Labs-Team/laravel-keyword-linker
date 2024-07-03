<?php

namespace The3LabsTeam\KeywordLinker;

class KeywordLinker
{
    public function parse(string $content, array $keywords): string
    {
        foreach ($keywords as $keyword => $link) {
            $content = preg_replace(
                "/\b($keyword)\b(?![^<]*>|[^<>]*<\/a>)/i",
                "<a href='$link'>$1</a>",
                $content
            );
        }

        return $content;
    }
}
