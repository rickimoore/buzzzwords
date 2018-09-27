<?php
/**
 * Created by PhpStorm.
 * User: rickimoore
 * Date: 8/12/18
 * Time: 12:39 PM
 */

namespace App;
use App\EnglishGrammar;

class ClassifyKeywords
{
    protected $classification;
    protected $classCount;
    protected $englishGrammar;

    public function __construct(EnglishGrammar $englishGrammar)
    {
        $this->englishGrammar = $englishGrammar;
    }

    public function HandleKeywordClassification ($text)
    {
        $this->stndizeList(strtolower($text))
        ->weighSortList($text)->scrubWeightList();

        return $this->classification;
    }

    private function scrubWeightList()
    {
        return $this->removeFlags($this->englishGrammar->listArticles())
            ->removeFlags($this->englishGrammar->listPronouns())->removeFlags($this->englishGrammar->listPrepositions())
            ->removeFlags($this->englishGrammar->listAdverbs())->removeFlags($this->englishGrammar->listConjunctions())
            ->removeFlags($this->englishGrammar->listInterjections())->removeFlags($this->englishGrammar->catchAll())
            ->removeFlags($this->englishGrammar->listStopWords());
    }

    private function removeFlags ($flag)
    {
        $this->classification = array_filter($this->classification, function ($key) use ($flag){
            return !in_array($key, $flag) && strlen($key) > 2;
        }, ARRAY_FILTER_USE_KEY);
        return $this;
    }

    private function weighSortList ($text)
    {
        $classified_obj = [];

        foreach ($this->classification as $item) {
            $classified_obj[$item] =  preg_match_all('/\b'. strtolower($item) .'\b/', strtolower($text)) / $this->classCount;
        }


        $this->classification = $classified_obj;
        asort($this->classification);

        return $this;
    }

    private function stndizeList($text)
    {
        $list = explode(' ', $text);
        $this->classification = preg_grep("/^[a-zA-Z ]*$/", $list);
        $this->classCount = count($this->classification);

        return $this;
    }
}