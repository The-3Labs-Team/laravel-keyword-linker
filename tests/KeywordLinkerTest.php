<?php

use The3LabsTeam\KeywordLinker\Facades\KeywordLinker;

beforeEach(function () {
    $this->keywords =
        [
            'test' => [
                'url' => 'https://example.com/test',
                'rel' => null,
                'target' => null,
            ],
            'example' => [
                'url' => 'https://example.com/example',
                'rel' => null,
                'target' => null,
            ],
        ];

    $this->relKeywords =
        [
            'test' => [
                'url' => 'https://example.com/test',
                'rel' => 'nofollow',
                'target' => null,
            ],
            'example' => [
                'url' => 'https://example.com/example',
                'rel' => 'sponsored',
                'target' => null,
            ],
        ];

    $this->targetKeywords =
        [
            'test' => [
                'url' => 'https://example.com/test',
                'rel' => null,
                'target' => '_blank',
            ],
            'example' => [
                'url' => 'https://example.com/example',
                'rel' => null,
                'target' => '_self',
            ],
        ];

    $this->relTargetKeywords =
        [
            'test' => [
                'url' => 'https://example.com/test',
                'rel' => 'nofollow',
                'target' => '_blank',
            ],
            'example' => [
                'url' => 'https://example.com/example',
                'rel' => 'sponsored',
                'target' => '_self',
            ],
        ];
});

it('can add link to keyword without tag', function () {
    $content = 'This is a test';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a test');
});

it('can add link to keyword', function () {
    $content = '<p>This is a test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a></p>');
});

it('can add link to keyword with different case', function () {
    $content = '<p>This is a Test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>Test</a></p>');
});

it('can add link to keyword with different case (uppercase)', function () {
    $content = '<p>This is a TEST</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>TEST</a></p>');
});

it('can add link to multiple keywords', function () {
    $content = '<p>This is a test example</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/example\'>example</a></p>');
});

it('cannot add link if already present', function () {
    $content = '<p>This is a <a href=\'https://example.com/test\'>test</a></p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a></p>');
});

it('cannot add link if already preset with rel attribute', function () {
    $content = '<p>This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a></p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a></p>');
});

it('cannot add link if text is an attribute of a img tag', function () {
    $content = '<p><img src="https://example.com/test" alt="This is a test "></p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p><img src="https://example.com/test" alt="This is a test "></p>');
});

it('can add link to 5 keywords', function () {
    $content = '<p>This is a test test test test test test example example</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    config(['keyword-linker.limit-auto-keywords' => 5]);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> test <a href=\'https://example.com/example\'>example</a> <a href=\'https://example.com/example\'>example</a></p>');
});

it('can add link to keyword without parsing into shortcodes', function () {
    $content = '<p>This is a [test]</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a [test]</p>');
});

//link with rel attribute nofollow
it('can add link to keyword with rel attribute nofollow', function () {
    $content = '<p>This is a test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->relKeywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a></p>');
});

//link with rel attribute sponsored
it('can add link to keyword with rel attribute sponsored', function () {
    $content = '<p>This is a example</p>';
    $parsedContent = KeywordLinker::parse($content, $this->relKeywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/example\' rel=\'sponsored\'>example</a></p>');
});

//link with target attribute _blank
it('can add link to keyword with target attribute _blank', function () {
    $content = '<p>This is a test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->targetKeywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\' target=\'_blank\'>test</a></p>');
});

//link with target attribute _self
it('can add link to keyword with target attribute _self', function () {
    $content = '<p>This is a example</p>';
    $parsedContent = KeywordLinker::parse($content, $this->targetKeywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/example\'>example</a></p>');
});

//link with rel and target attribute
it('can add link to keyword with rel and target attribute', function () {
    $content = '<p>This is a test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->relTargetKeywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\' rel=\'nofollow\' target=\'_blank\'>test</a></p>');
});

it('can add link to keyword with blockquote tag', function () {
    $content = '<blockquote>This is a test</blockquote>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<blockquote>This is a <a href=\'https://example.com/test\'>test</a></blockquote>');
});

it('can add link to keyword with multiple blockquote tags', function () {
    $content = '<blockquote>This is a test</blockquote><blockquote>This is a test</blockquote>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<blockquote>This is a <a href=\'https://example.com/test\'>test</a></blockquote><blockquote>This is a <a href=\'https://example.com/test\'>test</a></blockquote>');
});

it('cannot add link to keyword with blockquote tag', function () {
    $content = '<blockquote>This is a test</blockquote>';
    config(['keyword-linker.whitelist' => ['p']]);
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<blockquote>This is a test</blockquote>');
});

it('can add link to keyword with h2 tag', function () {
    $content = '<h2>This is a test</h2>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<h2>This is a test</h2>');
});

it('can add link to keyword with no whitelist', function () {
    $content = 'This is a test';
    config(['keyword-linker.whitelist' => []]);
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});

it('can add link to keyword with no whitelist (p)', function () {
    $content = '<p>This is a test</p>';
    config(['keyword-linker.whitelist' => []]);
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a></p>');
});

it('can add link to keyword with no whitelist (H2)', function () {
    $content = '<h2>This is a test</h2>';
    config(['keyword-linker.whitelist' => []]);
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<h2>This is a <a href=\'https://example.com/test\'>test</a></h2>');
});
