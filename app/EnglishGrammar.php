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
            '-', 'own', 'refer', 'careerbuilder', 'work', 'reward', 'earn', 'working', 'nowor', 'lots', 'got', 'doneyou', 'methodologiesangularjsjavajavascriptspringapply', 'methodologiesangularjsjavajavascriptspringagile', 'developeragile', 'jasminereactangularjsexperience'];
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

    public function listStopWords ()
    {
        return ["a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount",  "an", "and", "another", "any","anyhow","anyone","anything","anyway",
            "anywhere", "are", "around", "as",  "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could",
            "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first",
            "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if",
            "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never",
            "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re",
            "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them",
            "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two",
            "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose",
            "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the"];
    }
}