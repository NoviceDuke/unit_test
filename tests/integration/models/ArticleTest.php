<?php
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


 class testArticle extends TestCase
 {
    use DatabaseTransactions ;

      /** @test */
      function testArticles()
      {
        //Given
          factory(Article::class , 2 )->create();
          factory(Article::class )->create(['read' => 10 ]);
          $mostPopular = factory(Article::class)->create(['read' => 20 ]);
        //when
        $articles  = Article::trending();
        //Then
        $this -> assertEquals($mostPopular->id, $articles->first()->id);
        $this -> assertcount(3,$articles);
      }
 }
