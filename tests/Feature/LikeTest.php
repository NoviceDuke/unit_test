<?php

namespace Tests\Feature;
use App\Post ;
use App\User ;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikeTest extends TestCase
{
    public function testUserLikePost()
    {
      $post = factory(Post::class)->create();
      $user = factory(User::class)->create();
      //laravel provide function
      $this->actingAs($user);

      $post->like();

      $this->asserttrue($post->isLiked());

      $this->seeInDatabase('likes',[
        'user_id'=> $this->id,
        'likeable_id'=>$post->id,
        'likeable_type'=> get_class($post),
      ]);
    }
}
