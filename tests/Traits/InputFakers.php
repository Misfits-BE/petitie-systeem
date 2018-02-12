<?php 

namespace Tests\Traits;

/**
 * Trait helper for generation input
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Traits
 */
trait InputFakers
{
    /**
     * Generate fake input for the helpdesk category
     * 
     * @param  string $name         The name from the helpdesk category      
     * @param  string $color        The color value for the helpdesk categoryr
     * @param  string $description  The description for the helpdesk category
     * @return array
     */
    protected function fakeCategoryInput(string $name = 'category', string $color = '#000000', string $description = 'description'): array
    {
        return ['name' => $name, 'color' => $color, 'description' => $description];
    }
}