<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $fillable = ['name' , 'size'] ;

    public function add($user)
    {
      //guard
      $this ->guardAgainstTooManyMembers();

      $method = $user instanceOf User ?'save' :'saveMany';

      // if($user instanceOf User){
      //     return $this ->members()->save($user);
      // }

      $this ->members()->$method($user);
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
    protected function guardAgainstTooManyMembers()
    {
      if( $this->count() >= $this ->size){
        throw new \ErrorException;
      }
    }
}
