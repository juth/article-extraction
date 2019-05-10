<?php

namespace App\Http\Controllers;

use Goose\Client as GooseClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;


/**
 *  Extracts an article from a URL
 *
 *  @author  Steve Juth
 */
class ExtractArticleController extends Controller {
    
    const KEY = 'xrCOUxrOSc7YtbCAsE/M9wqo8AbjH0R3CLxYnxWgX8';

    public function extract(Request $request) {

        $key = $request->header('Authorization');

        if($key != static::KEY) {
            throw new AuthorizationException('wrong key used');
        }

        $result = (object) [
            'title'       => '',
            'description' => '',
            'keywords'    => '',
            'text'        => ''
        ];

        try {
            $goose   = new GooseClient();
            $article = $goose->extractContent($request->input('url'));

            $result->title       = $article->getTitle();
            $result->description = $article->getMetaDescription();
            $result->keywords    = $article->getMetaKeywords();
            $result->text        = $article->getCleanedArticleText();
        }
        catch(ClientException $e) {
            //  Swallow Guzzle exceptions, e.g., 404 errors
            $result->text = 'Not Found';
        }

        return json_encode($result);
    }
}
