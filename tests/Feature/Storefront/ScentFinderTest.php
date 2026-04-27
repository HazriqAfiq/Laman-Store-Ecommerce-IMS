<?php

namespace Tests\Feature\Storefront;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScentFinderTest extends TestCase
{
    use RefreshDatabase;

    public function test_scent_finder_page_can_be_rendered(): void
    {
        $response = $this->get(route('storefront.scent-finder'));

        $response->assertOk();
    }

    public function test_scent_finder_results_accept_valid_answers(): void
    {
        $response = $this->post(route('storefront.scent-finder.results'), [
            'answers' => [
                'vibe' => 'fresh',
                'intensity' => 'subtle',
                'time' => 'day',
            ],
        ]);

        $response->assertOk();
    }

    public function test_scent_finder_results_reject_invalid_answers(): void
    {
        $response = $this->from(route('storefront.scent-finder'))
            ->post(route('storefront.scent-finder.results'), [
                'answers' => [
                    'vibe' => 'random-value',
                ],
            ]);

        $response->assertRedirect(route('storefront.scent-finder'));
        $response->assertSessionHasErrors('answers.vibe');
    }
}
