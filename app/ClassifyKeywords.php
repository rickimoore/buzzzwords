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
            ->removeFlags($this->englishGrammar->listInterjections())->removeFlags($this->englishGrammar->catchAll());
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
            $classified_obj[$item] = preg_match_all('/\b'. strtolower($item) .'\b/', strtolower($text));
        }


        $this->classification = $classified_obj;
        asort($this->classification);

        return $this;
    }

    private function stndizeList($text)
    {
        $list = explode(' ', $text);
        $flags = [',', ' ', '  ', '?', '.', '!', '(', ')', "\n", '/', ':', '+', ';', '_','"', '*'];
        $recycled = [];

        //loop through list for the designated flags

        for($i = 0; $i < count($list); $i++)
        {
         $list[$i] = str_replace($flags, ' ', strtolower($list[$i]));


         //check for word splits

         if(strpos($list[$i], ' ') || strpos($list[$i], '  ') || strpos($list[$i], '   ')){
             $trash = array_filter(explode(' ', $list[$i]), function ($item){
                 return $item && $item !== ' ' && $item !== '  ' && $item !== '   ';
             });

             //remove old key and add new values to recycling

             $recycled = array_merge($recycled, $trash);

             $list[$i] = '';
         }
        }

        //combine filtered array and recycled array

        $this->classification = array_merge($recycled, array_filter($list, function ($item){
            return $item && $item !== ' ' && $item !== '  ';
        }));

        return $this;
    }
}