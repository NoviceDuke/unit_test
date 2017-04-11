<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $fillable = ['name' , 'size'] ;

    public function add($users)
    {
      //guard
      $this ->guardAgainstTooManyMembers($users);

      $method = $users instanceOf User ?'save' :'saveMany';

      // if($users instanceOf User){
      //     return $this ->members()->save($users);
      // }

      $this ->members()->$method($users);
    }

    public function members()
    {
      return $this->hasMany(User::class);
    }
    public function count()
    {
      return $this->members()->count();
    }
    public function remove($users = null)
    {
      // if(! $users){
      //   return $this->members()->update(['team_id' => null ]) ;
      // }
      if( $users instanceOf User)
       {
         return $users->leaveTeam();
       }
      //  $user->each(function($user){
      //    $user->leaveTeam();
      //  });
       //$userId = $users->pluck('id') ;

       return $this->removeMany($users) ;
    }
    public function removeMany($users)
    {
      return $this->members()
                  ->whereIn('id',$users->pluck('id'))
                  ->update(['team_id' => null ]);
    }
    public function restart()
    {
        return $this->members()->update(['team_id' => null ]) ;
    }
    protected function guardAgainstTooManyMembers($users)
    {
      $numUserToAdd = ($users instanceOf User)? 1: $users->count();
      $newTeamCount = $this->count() + $numUserToAdd;
      if( $newTeamCount > $this->size){
        throw new \ErrorException;
      }
    }
}
