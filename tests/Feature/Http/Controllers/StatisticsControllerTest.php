<?php

namespace Luchavez\SimpleStatistics\Feature\Http\Controllers;

use Tests\TestCase;

/**
 * Class StatisticsControllerTest
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class StatisticsControllerTest extends TestCase
{
    /**
     * Example Test
     *
     * @test
     */
    public function example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
