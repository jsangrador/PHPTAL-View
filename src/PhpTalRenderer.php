<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/jsangrador/PHPTAL-View
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/jsangrador/PHPTAL-View/blob/master/LICENSE.md (MIT License)
 */
namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;
#require_once(__DIR__.'/../vendor/phptal/phptal/classes/PHPTAL.php');
include "vendor/autoload.php";

/**
 * PhpTal View
 *
 * Render PHPTAL view templates into a PSR-7 Response object
 */
class PhpTalRenderer
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * SlimRenderer constructor.
     *
     * @param string $templatePath
     */
    public function __construct($templatePath = "")
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Render a template
     *
     * $data cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param \ResponseInterface $response
     * @param                    $template
     * @param array              $data
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render(ResponseInterface $response, $template, array $data = [])
    {
        if (isset($data['template'])) {
            throw new \InvalidArgumentException("Duplicate template key found");
        }

        if (!is_file($this->templatePath . $template)) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }

        $template = \PHPTAL::create($this->templatePath . $template);
        foreach($data as $key => $value) {
            $template->{$key} = $value;
        }
        $response->getBody()->write($template->execute());

        return $response;
    }
}
