<?php

namespace Site\Distribution\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Resource\Exception\InvalidFileException;
use TYPO3\CMS\Core\Site\Entity\NullSite;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FaviconMiddleware implements MiddlewareInterface
{
    protected ServerRequestInterface $request;

    /**
     * @throws InvalidFileException
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $this->request = $request;
        $this->addMetatagsToHead();

        return $handler->handle($this->request);
    }

    /**
     * @throws InvalidFileException
     */
    protected function addMetatagsToHead(): void
    {
        $site = $this->request->getAttribute('site');
        if ($site instanceof NullSite) {
            return;
        }

        $headerData = '';
        $siteConfig = $this->getSiteSettings($site);

        if ($siteConfig['touch']) {
            $headerData .= '<link rel="apple-touch-icon" href="' . $siteConfig['touch'] . '" sizes="180x180">';
        }

        if ($siteConfig['png']) {
            $headerData .= '<link rel="icon" href="' . $siteConfig['png'] . '" type="image/png" sizes="32x32">';
        }

        if ($siteConfig['svg']) {
            $headerData .= '<link rel="icon" href="' . $siteConfig['svg'] . '" type="image/svg+xml">';
        }

        GeneralUtility::makeInstance(PageRenderer::class)->addHeaderData($headerData);
    }

    /**
     * @return array{png: ?string,svg: ?string,touch: ?string}
     */
    protected function getSiteSettings(Site $site): array
    {
        $settings = $site->getSettings()->getAllFlat();

        return [
            'touch' => $settings['favicon.touch'] ?? null,
            'png' => $settings['favicon.png'] ?? null,
            'svg' => $settings['favicon.svg'] ?? null,
        ];
    }
}
