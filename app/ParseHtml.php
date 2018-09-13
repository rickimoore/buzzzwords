<?php
/**
 * Created by PhpStorm.
 * User: rickimoore
 * Date: 8/12/18
 * Time: 1:18 AM
 */

namespace App;
use Goutte\Client;


class ParseHtml

{
    protected $resultString;
    protected $isValid = true;

    public function handleHtmlParse ($data)
    {
        $client = new Client();

        $this->filterHtml($client->request('GET', $data['link']));

        return $this->resultString ?: null;
    }

    private function filterHtml ($crawler)
    {
        $crawler->filter('p, li, h1, h2, div.description')->each(function ($node) {
            $this->filterNode($node)->extractNode($node);
        });

        str_replace('\n', '', $this->resultString);
    }

    private function filterNode ($node)
    {
        $node->parents()->each(function ($parent) {
            if($parent->nodeName() === 'nav' ||
                $parent->nodeName() === 'footer' || $parent->nodeName() === 'header' ||
                $parent->nodeName() === 'form' || $parent->nodeName() === 'button' ||
                $parent->nodeName() === 'span'
            ){
                $this->isValid = false;
            }
        });

        return $this;
    }

    private function extractNode ($node)
    {
        if($this->isValid){
            $this->resultString .= $node->text();
        }
        $this->isValid = true;
    }
}