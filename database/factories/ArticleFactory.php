<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));
        $nombre = ucfirst($this->faker->unique()->words(random_int(2, 4), true));
        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'descripcion' => $this->faker->text(),
            'imagen' => 'fotos/' . $this->faker->picsum("public/storage/fotos", 640, 480, null, false),
            'precio' => $this->faker->randomFloat(2, 5, 999),
            'stock' => $this->faker->randomNumber(2, false),
            'user_id' => User::all()->random()->id,
        ];
    }
}
