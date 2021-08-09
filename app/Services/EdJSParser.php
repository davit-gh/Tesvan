<?php

namespace App\Services;

use DOMDocument;
use DOMText;
use Exception;
use Masterminds\HTML5;
use StdClass;

class EdJSParser
{
    /**
     * @var StdClass
     */
    private $data;

    /**
     * @var DOMDocument
     */
    private $dom;

    /**
     * @var HTML5
     */
    private $html5;

    /**
     * @var string
     */
    private $prefix = "prs";

    public function __construct($data)
    {
        $this->data = $data;
        $this->dom = new DOMDocument(1.0, 'UTF-8');
        $this->html5 = new HTML5([
            'target_document' => $this->dom,
            'disable_html_ns' => true
        ]);
    }

    static function parse($data)
    {
        return new self($data);
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getTime()
    {
        return isset($this->data['time']) ? $this->data['time'] : null;
    }

    public function getVersion()
    {
        return isset($this->data['version']) ? $this->data['version'] : null;
    }

    public function getBlocks()
    {
        return isset($this->data['blocks']) ? $this->data['blocks'] : null;
    }

    public function toHtml()
    {
        $this->init();

        return $this->dom->saveHTML();
    }

    /**
     * @throws Exception
     */
    private function init()
    {
        if (!$this->hasBlocks()) {
            return;
        };

        foreach ($this->getBlocks() as $block) {
            switch ($block['type']) {
                case 'header':
                    $this->parseHeader($block);
                    break;
                case 'table':
                    $this->parseTable($block);
                    break;
                case 'delimiter':
                    $this->parseDelimiter();
                    break;
                case 'code':
                    $this->parseCode($block);
                    break;
                case 'paragraph':
                    $this->parseParagraph($block);
                    break;
                case 'link':
                    $this->parseLink($block);
                    break;
                case 'embed':
                    $this->parseEmbed($block);
                    break;
                case 'raw':
                    $this->parseRaw($block);
                    break;
                case 'list':
                    $this->parseList($block);
                    break;
                case 'warning':
                    $this->parseWarning($block);
                    break;
                case 'image':
                case 'simpleImage':
                    $this->parseImage($block);
                    break;
                case 'quote':
                    $this->parseQuote($block);
                    break;
                default:
                    break;
            }
        }
    }

    private function hasBlocks()
    {
        return isset($this->data['blocks']) && count($this->data['blocks']) !== 0;
    }

    private function parseHeader($block)
    {
        $header = $this->dom->createElement('h' . $block['data']['level']);
        $header->setAttribute('class', "{$this->prefix}-h{$block['data']['level']}");
        $header->appendChild(new DOMText($block['data']['text']));

        $this->dom->appendChild($header);
    }

    public function parseTable($block)
    {
        $content = collect($block['data']['content']);

        $table = $this->dom->createElement('table');
        $table->setAttribute('class', "{$this->prefix}-table");
        if ($block['data']['withHeadings']) {
            $thead = $this->dom->createElement('thead');
            $tr = $this->dom->createElement('tr');

            $cols = $content->shift();
            foreach ($cols as $col) {
                $th = $this->dom->createElement('th');
                $th->appendChild($this->html5->loadHTMLFragment(empty($col) ? '&nbsp;' : $col));

                $tr->appendChild($th);
            }

            $thead->appendChild($tr);
            $table->appendChild($thead);
        }

        $tbody = $this->dom->createElement('tbody');
        foreach ($content as $cols) {
            $tr = $this->dom->createElement('tr');

            foreach ($cols as $col) {
                $td = $this->dom->createElement('td');
                $td->appendChild($this->html5->loadHTMLFragment(empty($col) ? '&nbsp;' : $col));

                $tr->appendChild($td);
            }

            $tbody->appendChild($tr);
        }

        $table->appendChild($tbody);

        $this->dom->appendChild($table);
    }

    private function parseDelimiter()
    {
        $node = $this->dom->createElement('hr');
        $node->setAttribute('class', "{$this->prefix}-delimiter");

        $this->dom->appendChild($node);
    }

    private function parseCode($block)
    {
        $content = new DOMText($block['data']['code']);
        $code = $this->dom->createElement('code');
        $code->appendChild($content);

        $copy = $this->dom->createElement('div');
        $copy->setAttribute('class', 'copy-btn');

        $img = $this->dom->createElement('img');
        $img->setAttribute('src', asset('images/copy-icon.png'));
        $img->setAttribute('height', '16px');
        $img->setAttribute('width', '14.5px');
        $copy->appendChild($img);

        $pre = $this->dom->createElement('pre');
        $pre->appendChild($code);

        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-code");
        $wrapper->appendChild($copy);
        $wrapper->appendChild($pre);

        $this->dom->appendChild($wrapper);
    }

    private function parseParagraph($block)
    {
        $node = $this->dom->createElement('p');
        $node->setAttribute('class', "{$this->prefix}-paragraph");
        $node->appendChild($this->html5->loadHTMLFragment($block['data']['text']));

        $this->dom->appendChild($node);
    }

    private function parseLink($block)
    {
        $link = $this->dom->createElement('a');

        $link->setAttribute('href', $block['data']['link']);
        $link->setAttribute('target', '_blank');
        $link->setAttribute('class', "{$this->prefix}-link");

        $innerContainer = $this->dom->createElement('div');
        $innerContainer->setAttribute('class', "{$this->prefix}-link-container");

        $hasTitle = isset($block['data']['meta']['title']);
        $hasDescription = isset($block['data']['meta']['description']);
        $hasImage = isset($block['data']['meta']['image']);

        if ($hasTitle) {
            $titleNode = $this->dom->createElement('div');
            $titleNode->setAttribute('class', "{$this->prefix}-link-title");
            $titleText = new DOMText($block['data']['meta']['title']);
            $titleNode->appendChild($titleText);
            $innerContainer->appendChild($titleNode);
        }

        if ($hasDescription) {
            $descriptionNode = $this->dom->createElement('div');
            $descriptionNode->setAttribute('class', "{$this->prefix}-link-description");
            $descriptionText = new DOMText($block['data']['meta']['description']);
            $descriptionNode->appendChild($descriptionText);
            $innerContainer->appendChild($descriptionNode);
        }

        $linkContainer = $this->dom->createElement('div');
        $linkContainer->setAttribute('class', "{$this->prefix}-link-url");
        $linkText = new DOMText($block['data']['link']);
        $linkContainer->appendChild($linkText);
        $innerContainer->appendChild($linkContainer);

        $link->appendChild($innerContainer);

        if ($hasImage) {
            $imageContainer = $this->dom->createElement('div');
            $imageContainer->setAttribute('class', "{$this->prefix}-link-img-container");
            $image = $this->dom->createElement('img');
            $image->setAttribute('src', $block['data']['meta']['image']['url']);
            $imageContainer->appendChild($image);
            $link->appendChild($imageContainer);
            $innerContainer->setAttribute('class', "{$this->prefix}-link-container-with-img");
        }

        $this->dom->appendChild($link);
    }

    private function parseEmbed($block)
    {
        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-embed");

        switch ($block['data']['service']) {
            case 'youtube':

                $attrs = [
                    'height' => $block['data']['height'],
                    'src' => $block['data']['embed'],
                    'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                    'allowfullscreen' => true
                ];

                $wrapper->appendChild($this->createIframe($attrs));

                break;
            case 'codepen' || 'gfycat':

                $attrs = [
                    'height' => $block['data']['height'],
                    'src' => $block['data']['embed'],
                ];

                $wrapper->appendChild($this->createIframe($attrs));

                break;
        }

        $this->dom->appendChild($wrapper);
    }

    private function createIframe(array $attrs)
    {
        $iframe = $this->dom->createElement('iframe');
        foreach ($attrs as $key => $attr) {
            $iframe->setAttribute($key, $attr);
        }

        return $iframe;
    }

    private function parseRaw($block)
    {
        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-raw");
        $wrapper->appendChild($this->html5->loadHTMLFragment($block['data']['html']));

        $this->dom->appendChild($wrapper);
    }

    private function parseList($block)
    {
        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-list");

        $list = null;

        switch ($block['data']['style']) {
            case 'ordered':
                $list = $this->dom->createElement('ol');
                break;
            default:
                $list = $this->dom->createElement('ul');
                break;
        }

        foreach ($block['data']['items'] as $item) {
            $li = $this->dom->createElement('li');
            $li->appendChild($this->html5->loadHTMLFragment($item['content']));
            $list->appendChild($li);
        }

        $wrapper->appendChild($list);

        $this->dom->appendChild($wrapper);
    }

    private function parseWarning($block)
    {
        $title = new DOMText($block['data']['title']);
        $message = new DOMText($block['data']['message']);

        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-warning");

        $textWrapper = $this->dom->createElement('div');
        $titleWrapper = $this->dom->createElement('p');

        $titleWrapper->appendChild($title);
        $messageWrapper = $this->dom->createElement('p');

        $messageWrapper->appendChild($message);

        $textWrapper->appendChild($titleWrapper);
        $textWrapper->appendChild($messageWrapper);

        $icon = $this->dom->createElement('ion-icon');
        $icon->setAttribute('name', 'information-outline');
        $icon->setAttribute('size', 'large');

        $wrapper->appendChild($icon);
        $wrapper->appendChild($textWrapper);

        $this->dom->appendChild($wrapper);
    }

    private function parseImage($block)
    {
        $figure = $this->dom->createElement('figure');
        $figure->setAttribute('class', "{$this->prefix}-image");

        $img = $this->dom->createElement('img');

        $imgAttrs = [];
        if ($block['data']['withBorder']) {
            $imgAttrs[] = "{$this->prefix}-image-border";
        }
        if ($block['data']['withBackground']) {
            $imgAttrs[] = "{$this->prefix}-image-background";
        }
        if ($block['data']['stretched']) {
            $imgAttrs[] = "{$this->prefix}-image-stretched";
        }

        $img->setAttribute('src', $block['data']['file']['url']);
        $img->setAttribute('class', implode(' ', $imgAttrs));

        $figure->appendChild($img);

        if (!empty($block['data']['caption'])) {
            $figCaption = $this->dom->createElement('figcaption');
            $figCaption->appendChild($this->html5->loadHTMLFragment($block['data']['caption']));
            $figure->appendChild($figCaption);
        }

        $this->dom->appendChild($figure);
    }

    public function parseQuote($block)
    {
        $quote = $this->dom->createElement('div');
        $quote->setAttribute('class', "{$this->prefix}-quote");

        $title = $this->dom->createElement('div');
        $title->setAttribute('class', "{$this->prefix}-quote-title");
        $title->appendChild($this->html5->loadHTMLFragment($block['data']['caption']));
        $quote->appendChild($title);

        $content = $this->dom->createElement('div');
        $content->setAttribute('class', "{$this->prefix}-quote-content");

        $rows = [];
        $textsPerRow = explode('<br>', $block['data']['text']);
        foreach ($textsPerRow as $row) {
            $rows[] = preg_replace('/\[(.+)\]\((.+)\)/', '<a href="$2" target="_blank">$1</a>', $row);
        }

        $content->appendChild($this->html5->loadHTMLFragment(implode("<br>", $rows)));
        $quote->appendChild($content);

        $this->dom->appendChild($quote);
    }
}
