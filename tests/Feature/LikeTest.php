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


      $this->assertDatabaseHas('likes',[
        'user_id'=> $user->id,
        'likeable_id'=>$post->id,
        'likeable_type'=> get_class($post),
      ]);
      $this->asserttrue($post->isLiked());
    }
    public function testUserUnlikePost()
    {
      $post = factory(Post::class)->create();
      $user = factory(User::class)->create();
      //laravel provide function
      $this->actingAs($user);

      $post->like();
      $post->unlike();

      $this->assertDatabaseMissing('likes',[
        'user_id'=> $user->id,
        'likeable_id'=>$post->id,
        'likeable_type'=> get_class($post),
      ]);
      $this->assertfalse($post->isLiked());
    }
    public function testUserCanTogglePostLike()
    {
      $post = factory(Post::class)->create();
      $user = factory(User::class)->create();
      //laravel provide function
      $this->actingAs($user);

      $post->like();
      $post->unlike();

      $this->assertDatabaseMissing('likes',[
        'user_id'=> $user->id,
        'likeable_id'=>$post->id,
        'likeable_type'=> get_class($post),
      ]);
      $this->assertfalse($post->isLiked());
    }
}
