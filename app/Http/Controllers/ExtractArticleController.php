<?php

namespace App\Http\Controllers;

use Goose\Client as GooseClient;
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

        $result = [];

        $goose   = new GooseClient();
        $article = $goose->extractContent($request->input('url'));

        $result['title']       = $article->getTitle();
        $result['description'] = $article->getMetaDescription();
        $result['keywords']    = $article->getMetaKeywords();
        $result['text']        = $article->getCleanedArticleText();

        return json_encode((object) $result);
    }
}
