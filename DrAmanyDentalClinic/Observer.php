<?php

abstract class AbstractObserver 
{
    abstract function update(AbstractSubject $subject_in);
}

abstract class AbstractSubject 
{
    abstract function register(AbstractObserver $observer_in);
    abstract function remove(AbstractObserver $observer_in);
    abstract function notify();
}

function writeln($line_in)
{
    echo $line_in."<br/>";
}

class PatternObserver extends AbstractObserver 
{
    public function __construct() 
    {
    }
    public function update(AbstractSubject $subject) 
    {
      writeln('*UPDATE*');
      writeln(' Reservation added to : '.$subject->getFavorites());
     
    }
}

class PatternSubject extends AbstractSubject 
{
    private $favoritePatterns = NULL;
    private $observers = array();
    function __construct() {
}
    function register(AbstractObserver $observer_in)
    {
      $this->observers[] = $observer_in;
    }
    function remove(AbstractObserver $observer_in)
    {
      foreach($this->observers as $okey => $oval) 
      {
        if ($oval == $observer_in) 
        { 
          unset($this->observers[$okey]);
        }
      }
    }
    function notify() 
    {
      foreach($this->observers as $obs) 
      {
        $obs->update($this);
      }
    }
    
    function updateFavorites($newFavorites)
    {
      $this->favorites = $newFavorites;
      $this->notify();
    }
    function getFavorites()
    {
      return $this->favorites;
    }
}


?>