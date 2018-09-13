<?php
/**
 * Created by PhpStorm.
 * User: rickimoore
 * Date: 8/12/18
 * Time: 5:28 PM
 */

namespace App;


class EnglishGrammar
{
    public function listPronouns ()
    {
        return ['he', 'she', 'you', 'i', 'they', 'them', 'it', 'we', 'us',
            'their', 'our', 'ours', 'theirs', 'his', 'hers', 'yours', 'my', 'myself', 'yourself', 'themselves',
            'himself', 'herself', 'ourselves', 'your'];
    }

    public function listPrepositions ()
    {
        return ['with', 'at', 'from', 'into', 'during', 'including', 'until', 'against', 'among', 'throughout', 'despite', 'towards', 'upon', 'concerning',
            'of', 'to', 'in', 'for', 'on', 'by', 'about', 'like', 'through', 'over', 'before', 'between', 'after', 'since', 'without', 'under', 'within', 'along', 'following',
            'across', 'behind', 'beyond', 'plus', 'except', 'but', 'up', 'out', 'around', 'down', 'off', 'above', 'near'];
    }

    public function listAdverbs ()
    {
        return ['now', 'then', 'today', 'tomorrow', 'tonight', 'yesterday'];
    }

    public function listArticles ()
    {
        return ['a', 'the', 'one', 'some', 'few', 'as', 'and'];
    }

    public function catchAll ()
    {
        return ['if', 'is', 'have', 'has', 'having', 'or', 'an', 'are', 'other', 'will', 'sign', 'up', 'be', 'than', 'do', 'more', 'can', 'who', 'this', 'get', 'that', 'you\'re', 'not',
        'which', 'know', 'only', 'let', 'oo', 'apply', 'job', 'to', 'this', 'must', 'may', 'hire', 'each', 'also', 'you\'ll', 'pay', 'thing', 'things', 'meet', 'jobs',
            '-', 'own', 'refer', 'careerbuilder'];
    }

    public function listConjunctions ()
    {
        return [
            'And', 'Or', 'But', 'Nor', 'So', 'For', 'Yet', 'After', 'Although', 'As', 'As If', 'As Long As', 'Because', 'Before', 'Even If', 'Even Though', 'Once',
                'Since', 'So That', 'Though', 'Till', 'Unless', 'Until', 'What', 'When', 'Whenever', 'Wherever', 'Whether', 'While',
        ];
    }

    public function listInterjections ()
    {
        return [
            'ah', 'a-ha', 'ahem', 'alas', 'amen', 'aw', 'awesome', 'bada', 'bing', 'bah', 'baloney', 'big', 'bingo', 'boo', 'deal', 'boohoo',
            'booya', 'boy', 'bravo', 'brilliant', 'brrr', 'bull', 'bye', 'cheers', 'come', 'cool,', 'cowabunga', 'dang', 'darn', 'dear', 'duck',
            'duh', 'eh', 'enjoy', 'excellent', 'fabulous', 'fantastic', 'fiddledeedee', 'finally', 'for', 'fore,', 'foul', 'freeze', 'gee', 'giddyap', 'golly',
            'goodbye', 'good grief', 'good', 'gosh', 'great', 'balls', 'ha', 'hallelujah', 'heigh-ho', 'hello', 'help', 'hey', 'hi', 'hip', 'hmm', 'ho', 'ho-hum', 'hooray',
            'howdy', 'huh', 'ick', 'indeed', 'jeez', 'kaboom', 'kapow', 'lordy', 'mama', 'man', 'marvelous', 'my',
            'goodness', 'no problem', 'no way', 'nope', 'nuts', 'ok', 'ouch', 'ow', 'please', 'poof', 'shh', 'super', 'swell', 'welcome', 'well', 'whoop-de-doo', 'wow', 'yippee','yummy'
        ];
    }
}