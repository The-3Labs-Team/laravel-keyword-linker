<?php

use The3LabsTeam\KeywordLinker\KeywordLinker;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('can add link to keyword', function () {
    $content = 'This is a test';
    $keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});

it('can add link to keyword with different case', function () {
    $content = 'This is a Test';
    $keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>Test</a>');
});

it('can add link to keyword with different case (uppercase)', function () {
    $content = 'This is a TEST';
    $keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>TEST</a>');
});

it('can add link to multiple keywords', function () {
    $content = 'This is a test example';
    $keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a> <a href=\'https://example.com/example\'>example</a>');
});

it('should not add link if already present', function () {
    $content = 'This is a <a href=\'https://example.com/test\'>test</a>';
    $keywords = ['test' => 'https://example.com/test', 'example' => 'https://example.com/example'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)->toBe('This is a <a href=\'https://example.com/test\'>test</a>');
});

//multipli links in un testo lungo
it('can add link to multiple keywords in a long text', function () {
    $content = 'Quest\'anno è previsto un significativo sviluppo dell\'intelligenza artificiale generativa (GenAI) nel settore aziendale, come sottolineato da numerosi esperti del settore. Una delle metodologie che potrebbero contribuire a questo sviluppo è la Retrieval-Augmented Generation (RAG), un sistema in cui un modello di linguaggio di grandi dimensioni viene collegato a un database contenente contenuti specifici del dominio, come i file aziendali. Tuttavia, la RAG è una tecnologia emergente che presenta diverse sfide.';
    $keywords = ['intelligenza artificiale' => 'https://example.com/intelligenza-artificiale-generativa', 'RAG' => 'https://example.com/RAG'];
    $parsedContent = KeywordLinker::parse($content, $keywords);
    expect($parsedContent)
        ->toBe('Quest\'anno è previsto un significativo sviluppo dell\'<a href=\'https://example.com/intelligenza-artificiale-generativa\'>intelligenza artificiale</a> generativa (GenAI) nel settore aziendale, come sottolineato da numerosi esperti del settore. Una delle metodologie che potrebbero contribuire a questo sviluppo è la Retrieval-Augmented Generation (<a href=\'https://example.com/RAG\'>RAG</a>), un sistema in cui un modello di linguaggio di grandi dimensioni viene collegato a un database contenente contenuti specifici del dominio, come i file aziendali. Tuttavia, la <a href=\'https://example.com/RAG\'>RAG</a> è una tecnologia emergente che presenta diverse sfide.');
});
