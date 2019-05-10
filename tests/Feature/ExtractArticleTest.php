<?php

namespace Tests\Feature;

use App\Http\Controllers\ExtractArticleController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/**
 *  Testcases for aricle extraction
 *
 *  @author  Steve Juth
 */
class ExtractArticleTest extends TestCase {

    /**
     *  Tests article extraction
     */
    public function testExtraction() {

        $url = 'https://www.road2college.com/15-best-paying-part-time-jobs-for-high-school-students';

        $response = $this->json('POST', '/api/article', 
            ['url' => $url], ['Authorization' => ExtractArticleController::KEY]);

        $response->assertStatus(200);

        //$response->assertJson(json_decode('{"yo": "baby"}', true));
    }

    /**
     *  Tests article extraction with an invalid key
     */
    public function testExtractionWithBadKey() {

        $url = 'https://www.road2college.com/15-best-paying-part-time-jobs-for-high-school-students';

        $response = $this->json('POST', '/api/article', 
            ['url' => $url], ['Authorization' => '1234567890']);

        $response->assertStatus(403);
    }
}
