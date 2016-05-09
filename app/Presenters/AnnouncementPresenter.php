<?php

namespace emutoday\Presenters;

use Lewis\Presenter\AbstractPresenter;

class AnnouncementPresenter extends AbstractPresenter
{
  public function __construct($object)
  {
      parent::__construct($object);
  }


  public function timelineHighlight()
  {
      if ($this->start_date && $this->end_date) {
          if ($this->end_date->isPast()) {
            //event is over
              return 'medium-gray';
          } elseif ($this->start_date->isFuture()) {
            //event is upcoming
              return 'warning';
          } elseif ($this->start_date->isPast() && $this->end_date->isFuture()) {
            //event is going on right now
              return 'success';
          } else {
              return 'alert';
          }

      } else {
        return 'alert';
      }
  }

}