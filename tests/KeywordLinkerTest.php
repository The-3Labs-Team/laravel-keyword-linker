<?php

use The3LabsTeam\KeywordLinker\Facades\KeywordLinker;

beforeEach(function () {
    $this->keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
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
