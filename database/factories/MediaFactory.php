<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Nette\Utils\attributes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return [
            'url' => $url,
            'mime' => $mime,
            'mediable_id' => Post::factory(),
            'mediable_type' => function (array $attributes) {
                return Post::find($attributes['mediable_id'])->getMorphClass();
            }
        ];
    }


    function getUrl($type = 'post'): string
    {
        switch ($type) {
            case 'post':
                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
                    'https://images.unsplash.com/photo-1683009427041-d810728a7cb6?q=80&w=1886&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'https://plus.unsplash.com/premium_photo-1707194008324-ef357d453723?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'https://images.unsplash.com/photo-1682686578842-00ba49b0a71a?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                ];
                return $this->faker->randomElement($urls);

                break;

            case 'reel':
                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/VolkswagenGTIReview.mp4'
                ];
                return $this->faker->randomElement($urls);


            default:
                return null;
        }
    }

    function getMime($url): string
    {
        if (str()->contains($url, 'gtv-videos-bucket')) {
            return 'video';
        } elseif (str()->contains($url, 'unsplash.com')) {
            return 'image';
        }
    }


    function reel() {
        $url = $this->getUrl('reel');
        $mime = $this->getMime($url);

        return $this->state(function (array $attributes) use($url, $mime) {
            return [
                'url' => $url,
                'mime' => $mime
            ];
        });
    }

    function post() {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return $this->state(function (array $attributes) use($url, $mime) {
            return [
                'url' => $url,
                'mime' => $mime
            ];
        });
    }
}
