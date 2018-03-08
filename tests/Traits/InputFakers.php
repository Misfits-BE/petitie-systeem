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

    /**
     * Generate fake input for the ban reasons. 
     * 
     * @param  string $reason   A simple reason text for banning the user.
     * @return array
     */
    protected function fakeBanInput(string $reason = 'Ban reason'): array 
    {
        return ['reason' => $reason];
    }
    
    /**
     * Generate fake input for user comments.
     * 
     * @param  string $comment   A basic comment input. Defaults to 'user comment'
     * @return array
     */
    protected function fakeCommentInput(string $comment = 'User comment'): array
    {
        return ['comment' => $comment];
    }

    /**
     * Generate fake input for a uqser signature. 
     * 
     * @param  int     $country_id      The unique identifier for the country in the database
     * @param  string  $city            The name of the city where the user lives
     * @param  string  $email           The email adress for the user
     * @param  string  $lastname        The lastname from the user
     * @param  string  $firstname       The firstname from the user
     * @return array
     */
    protected function fakeSignatureInput(
        int    $country_id = 200,
        string $city = 'name', 
        string $email = 'example@domain.tld',
        string $lastname = 'Doe',
        string $firstname  = 'john'
    ): array 
    {
        return ['city' => $city, 'email' => $email, 'lastname' => $lastname, 'firstname' => $firstname, 'country_id' => $country_id];
    }
}