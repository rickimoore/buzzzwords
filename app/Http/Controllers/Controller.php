<?php

namespace App\Http\Controllers;

use App\JobOffer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\ParseHtml;
use App\ClassifyKeywords;
use App\CollectLink;
use League\Flysystem\Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $parseHtml;
    protected $classifyKeywords;
    protected $collectLink;

    public function __construct(parseHtml $parseHtml, classifyKeywords $classifyKeywords, collectLink $collectLink)
    {
        $this->parseHtml = $parseHtml;
        $this->classifyKeywords = $classifyKeywords;
        $this->collectLink = $collectLink;
    }


    public function index ()
    {
        dd(getenv('CLEARDB_DATABASE_URL'));
        return view('welcome', ['offers' => JobOffer::fetchValidOffers()]);
    }

    public function analayze (Request $request)
    {
        try {
            $parsedHtml = $this->parseHtml->handleHtmlParse($request->all());
        } catch (Exception $exception)
        {
            return response()->json([
                'status' => 'error',
                'exception' => $exception
            ]);
        }

        if($parsedHtml){
            $classification = $this->classifyKeywords->HandleKeywordClassification(strtolower($parsedHtml));

            $this->collectLink->processLink($request->all(), $classification);

            return response()->json([
                'status' => 'success',
                'data' => $classification
            ]);
        }
    }
}
