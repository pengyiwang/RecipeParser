<?php

use PHPUnit\Framework\TestCase;
require_once dirname(__FILE__) . '/../bootstrap.php';

class Test extends TestCase {

    private function getDataDir() {
        return dirname(__FILE__) . "/data";
    }

    function test_match_schema_markup() {
        $html = file_get_contents($this->getDataDir() . "/schema_spec.html");
        $type = RecipeParser::matchMarkupFormat($html);
        $this->assertEquals(RecipeParser::SCHEMA_SPEC, $type);

    }

    function test_match_datavocabulary_markup() {
        $html = file_get_contents($this->getDataDir() . "/datavocabulary_spec.html");
        $type = RecipeParser::matchMarkupFormat($html);
        $this->assertEquals(RecipeParser::DATA_VOCABULARY_SPEC, $type);
    }

    function test_match_microformat_markup() {
        $html = file_get_contents($this->getDataDir() . "/microformat_spec.html");
        $type = RecipeParser::matchMarkupFormat($html);
        $this->assertEquals(RecipeParser::MICROFORMAT_SPEC, $type);
    }

    function test_null_match_markup() {
        $html = file_get_contents($this->getDataDir() . "/no_semantic_markup.html");
        $type = RecipeParser::matchMarkupFormat($html);
        $this->assertEquals(null, $type);
    }

    /**
     * @expectedException NoMatchingParserException
     */
    function test_parser_no_matching_parser_exception() {
        $html = "";
        $url = "http://www.example.com/";
        $recipe = RecipeParser::parse($html, $url);
    }

}

