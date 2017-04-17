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
    use DatabaseTransactions;

    protected $post ;

    public function setUp()
    {
      parent::setUp();

      //$this->post = factory(Post::class)->create();
      $this->post = createPost();
      $this->signIn();
    }
    public function testUserLikePost()
    {

      $this->post->like();


      $this->assertDatabaseHas('likes',[
        'user_id'=> $this->user->id,
        'likeable_id'=>$this->post->id,
        'likeable_type'=> get_class($this->post),
      ]);
      $this->asserttrue($this->post->isLiked());
    }
    public function testUserUnlikePost()
    {

      $this->post->like();
      $this->post->unlike();

      $this->assertDatabaseMissing('likes',[
        'user_id'=> $this->user->id,
        'likeable_id'=>$this->post->id,
        'likeable_type'=> get_class($this->post),
      ]);
      $this->assertfalse($this->post->isLiked());
    }
    public function testUserCanTogglePostLike()
    {

      $this->post->toggle();
      $this->assertTrue($this->post->isLiked());

      $this->post->toggle();
      $this->assertfalse($this->post->isLiked());
    }
    public function testPostCountLike()
    {


      $this->post->toggle();
      $this->assertequals(1,$this->post->likesCount);
    }
}
