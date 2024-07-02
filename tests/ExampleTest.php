<?php

it('can test', function () {
    expect(true)->toBeTrue();
});

it('can add link to keyword', function () {
    $content = 'This is a test';
    $keywords = ['test'];
    $keywordLinker = new The3LabsTeam\KeywordLinker\KeywordLinker($content, $keywords);
    $parsedContent = $keywordLinker->parse();
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});
