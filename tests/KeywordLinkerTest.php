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

it('can add link to keyword', function () {
    $content = 'This is a test';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});

it('can add link to keyword inside a <p> tag', function () {
    $content = '<p>This is a test</p>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<p>This is a <a href=\'https://example.com/test\'>test</a></p>');
});

it('can add link to keyword with different case', function () {
    $content = 'This is a Test';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>Test</a>');
});

it('can add link to keyword with different case (uppercase)', function () {
    $content = 'This is a TEST';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>TEST</a>');
});

it('can add link to multiple keywords', function () {
    $content = 'This is a test example';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/example\'>example</a>');
});

it('cannot add link if already present', function () {
    $content = 'This is a <a href=\'https://example.com/test\'>test</a>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});

it('cannot add link if already preset with rel attribute', function () {
    $content = 'This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a>';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a>');
});

it('cannot add link if text is an attribute of a img tag', function () {
    $content = '<img src="https://example.com/test" alt="This is a test ">';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('<img src="https://example.com/test" alt="This is a test ">');
});

it('can add link to 5 keywords', function () {
    $content = 'This is a test test test test test test example example';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    config(['keyword-linker.limit-auto-keywords' => 5]);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/test\'>test</a> test <a href=\'https://example.com/example\'>example</a> <a href=\'https://example.com/example\'>example</a>');
});

it('can add link to keyword without parsing into shortcodes', function () {
    $content = 'This is a [test]';
    $parsedContent = KeywordLinker::parse($content, $this->keywords);
    expect($parsedContent)->toBe('This is a [test]');
});

//link with rel attribute nofollow
it('can add link to keyword with rel attribute nofollow', function () {
    $content = 'This is a test';
    $parsedContent = KeywordLinker::parse($content, $this->relKeywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\' rel=\'nofollow\'>test</a>');
});

//link with rel attribute sponsored
it('can add link to keyword with rel attribute sponsored', function () {
    $content = 'This is a example';
    $parsedContent = KeywordLinker::parse($content, $this->relKeywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/example\' rel=\'sponsored\'>example</a>');
});

//link with target attribute _blank
it('can add link to keyword with target attribute _blank', function () {
    $content = 'This is a test';
    $parsedContent = KeywordLinker::parse($content, $this->targetKeywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\' target=\'_blank\'>test</a>');
});

//link with target attribute _self
it('can add link to keyword with target attribute _self', function () {
    $content = 'This is a example';
    $parsedContent = KeywordLinker::parse($content, $this->targetKeywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/example\'>example</a>');
});

//link with rel and target attribute
it('can add link to keyword with rel and target attribute', function () {
    $content = 'This is a test';
    $parsedContent = KeywordLinker::parse($content, $this->relTargetKeywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\' rel=\'nofollow\' target=\'_blank\'>test</a>');
});
