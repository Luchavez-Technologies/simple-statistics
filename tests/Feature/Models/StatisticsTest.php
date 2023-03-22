<?php

namespace Luchavez\SimpleStatistics\Feature\Models;

use Tests\TestCase;

/**
 * Class StatisticsTest
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class StatisticsTest extends TestCase
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
