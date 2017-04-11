<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions ;
    /** @test */
    public function testTeamHasName()
    {
      $team = new Team (['name' => 'Hero']);

      $this ->assertEquals('Hero' , $team->name);
    }

    /** @test */
    public function testTeamCanAddMember()
    {
      $team = factory(Team::class)->create();

      $member = factory(User::class)->create();
      $member2 = factory(User::class)->create();

      $team->add($member);
      $team->add($member2);

      $this->assertequals(2,$team->count());
    }
    /** @test */
    public function testTeamHasMaxSize()
    {
      $team = factory(Team::class)->create(['size' => 2 ]);

      $user1 = factory(User::class)->create();
      $user2 = factory(User::class)->create();

      $team->add($user1);
      $team->add($user2);

      $this->assertequals(2,$team->count());

      $this->setexpectedexception('Exception');

      $user3 = factory(User::class)->create();
      $team->add($user3);
    }
    /** @test */
    public function testTeamCanAddMultipleMemberAtOnce()
    {
      $team = factory(Team::class)->create();

      $users = factory(User::class, 2)->create() ;

      $team->add($users);

      $this->assertequals(2,$team->count());

    }
    /** @test */
    public function testTeamCanRemoveMember()
    {
      $team = factory(Team::class)->create();

      $users = factory(User::class , 2)->create();

      $team->add($users);

      $team ->remove($users[0]);

      $this->assertequals(1,$team->count());
    }
    public function testTeamCanRemoveAllMember()
    {
      $team = factory(Team::class)->create();

      $users = factory(User::class , 2)->create();

      $team->add($users);

      $team ->restart();

      $this->assertequals(0,$team->count());

    }
    public function testTeamCanRemoveMoreMember()
    {
      $team = factory(Team::class)->create(['size' => 3]);

      $users = factory(User::class , 3)->create();

      $team->add($users);

      $team->remove($users->slice(0,2)) ;

      $this ->assertequals(1 , $team->count());
    }
    public function testTeamAddMaxMember()
    {
      $team = factory(Team::class)->create(['size' => 2]);

      $users = factory(User::class , 3)->create();

      $this->setexpectedexception('Exception');
      
      $team->add($users);



    }
}
