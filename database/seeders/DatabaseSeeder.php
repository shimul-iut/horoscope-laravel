<?php

namespace Database\Seeders;

Use App\Models\Zodiac;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Zodiac::create(['name' => 'Aries' , 'icon' => 'aries.png' , 'magic_number' => 5, 'celebrities' => 'Hans Christian Andersen, Jackie Chan, Mariah Carey, Marlon Brando, Dennis Quaid']);
        Zodiac::create(['name' => 'Taurus' , 'icon' => 'taurus.png' , 'magic_number' => 6, 'celebrities' => 'Karl Marx, William Shakespeare, Leonardo da Vinci, David Beckham, Al Pacino']);
        Zodiac::create(['name' => 'Gemini' , 'icon' => 'gemini.png' , 'magic_number' => 7, 'celebrities' => 'John F. Kennedy, Queen Victoria']);
        Zodiac::create(['name' => 'Cancer' , 'icon' => 'cancer.png' , 'magic_number' => 2, 'celebrities' => 'Alexander the Great, Raul Gonzalez']);
        Zodiac::create(['name' => 'Leo' , 'icon' => 'leo.png' , 'magic_number' => 19, 'celebrities' => 'Napoleon Bonaparte, Deng Xiaoping, Alexander Dumas, Jennifer Lopez, Whitney Houston, Sarah Brightman']);
        Zodiac::create(['name' => 'Virgo' , 'icon' => 'virgo.png' , 'magic_number' => 7, 'celebrities' => ' Warren Buffett, Kobe Bryant, Michael Jackson, Rebecca De Mornay, Richard Gere']);
        Zodiac::create(['name' => 'Libra' , 'icon' => 'libra.png' , 'magic_number' => 3, 'celebrities' => 'Oscar Wilde, Hillary Duff, Italo Calvino, Evander Hoilrield']);
        Zodiac::create(['name' => 'Scorpio' , 'icon' => 'scorpio.png' , 'magic_number' => 4, 'celebrities' => 'Charles de Gaulle, Bill Gates, Marie Curie, Hillary Clinton, Julia Roberts, Pablo Picasso']);
        Zodiac::create(['name' => 'Sagittarius' , 'icon' => 'sagittarius.png' , 'magic_number' => 6, 'celebrities' => 'Mark Twain, Beethoven, Taylor Swift, Britney Spears']);
        Zodiac::create(['name' => 'Capricorn' , 'icon' => 'capricorn.png' , 'magic_number' => 4, 'celebrities' => 'Mao Zedong, Issac Newton, Martin Luther King, Nicholas Cage']);
        Zodiac::create(['name' => 'Aquariusies' , 'icon' => 'aquarius.png' , 'magic_number' => 22, 'celebrities' => 'Francis Bacon, Thomas Edison, Agyness Deyn, Paris Hilton']);
        Zodiac::create(['name' => 'Pisces' , 'icon' => 'pisces.png' , 'magic_number' => 11, 'celebrities' => 'George Washington, Zhou Enlai, Albert Einstein, Justin Bieber']);
    }
}
