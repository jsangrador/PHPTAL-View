<?php
use Slim\Http\Body;
use Slim\Http\Headers;
use Slim\Http\Response;

class PhpTalRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testRenderer() {
        $renderer = new \Slim\Views\PhpTalRenderer("tests/");

        $headers = new Headers();
        $body = new Body(fopen('php://temp', 'r+'));
        $response = new Response(200, $headers, $body);

        $newResponse = $renderer->render($response, "testTemplate.html", array("hello" => "Hi"));

        $newResponse->getBody()->rewind();

        $this->assertEquals("Hi", $newResponse->getBody()->getContents());
    }
}
