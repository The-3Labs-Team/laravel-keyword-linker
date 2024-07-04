<?php

namespace The3LabsTeam\KeywordLinker;

class KeywordLinker
{
    /**
     * @param  array  $keywords  - ['keyword' => ['link' => 'url', 'rel' => 'nofollow', 'target' => '_blank']]
     */
    public function parse(string $content, array $keywords): string
    {
        $limit = config('keyword-linker.limit-auto-keywords') ?? -1;
        $whiteList = self::getWhiteList();

        foreach ($keywords as $keyword => $data) {
            $link = $data['url'];
            $rel = $data['rel'] ? ' rel=\''.$data['rel'].'\'' : '';
            $target = $data['target'] && $data['target'] !== '_self' ? ' target=\''.$data['target'].'\'' : '';

            $replacement = "<a href='$link'$rel$target>$1</a>";

            $content = preg_replace(
                "/\b($keyword)\b(?=($whiteList))(?![^<]*>|[^<>]*<\/a>|[^[]*\])/i",
                $replacement,
                $content,
                $limit
            );
        }

        return $content;
    }

    protected static function getWhiteList(): string
    {
        $whiteList = config('keyword-linker.whitelist');
        $parseWhiteList = '';
        foreach ($whiteList as $index => $tag) {
            $parseWhiteList .= ".*<\/$tag>".($index < count($whiteList) - 1 ? '|' : '');
        }

        return $parseWhiteList;
    }
}
