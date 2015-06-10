<?php namespace Views;

class Field {
    private $height;
    private $width;
    private $floor_height;
    private $wall_width;
    private $floor_symbol;
    private $wall_symbol;
    private $blank;
    private $blank_return;
    //private $fighter_symbol;
    private $fighter_coord;
    private $bullets;
    private $invaders;
    
    private $field;
    
    public function __construct($data) {
        $this->height = \Libraries\Func::arrayGet($data, 'height', 25);
        $this->width = \Libraries\Func::arrayGet($data, 'width', 25);
        $this->floor_height = \Libraries\Func::arrayGet($data, 'floor_height', 1);
        $this->wall_width = \Libraries\Func::arrayGet($data, 'wall_width', 1);
        $this->floor_symbol = \Libraries\Func::arrayGet($data, 'floor_symbol', '@');
        $this->wall_symbol = \Libraries\Func::arrayGet($data, 'wall_symbol', '|');
        $this->blank = \Libraries\Func::arrayGet($data, 'blank', 50);
        $this->blank_return = \Libraries\Func::arrayGet($data, 'blank_return', '
');
      //  $this->fighter_symbol = \Libraries\Func::arrayGet($data, 'fighter_symbol', '^');
        $this->fighter_coord = \Libraries\Func::arrayGet($data, 'fighter_coord', array(
            'x' => 1,
            'y' => 1,
            'symbol' => '^'
        ));
        $this->bullets = \Libraries\Func::arrayGet($data, 'bullets', array());
        $this->invaders = \Libraries\Func::arrayGet($data, 'invaders', array());
    }
    
    public function drawField() {
        $this->field = '';
        for ($i = 0; $i < $this->blank; $i++) {
            $this->field .= $this->blank_return;
        }
        for ($i = 0; $i < $this->height - $this->floor_height; $i++) {
            $this->field .= $this->wall_symbol;
            for ($j = 0; $j < $this->width - 2 * $this->wall_width; $j++) {
                $symbol = ' ';
                if ($j == $this->fighter_coord['x'] && $i == $this->fighter_coord['y']) {
                    $symbol = $this->fighter_coord['symbol'];
                } else {
                    foreach ($this->bullets as $bullet) {
                        if ($j == $bullet['x'] && $i == $bullet['y']) {
                            $symbol = $bullet['symbol'];
                        }
                    }
                    foreach ($this->invaders as $invader) {
                        if ($j == $invader['x'] && $i == $invader['y']) {
                            $symbol = $invader['symbol'];
                        }
                    }
                }
                $this->field .= $symbol;
            }
            $this->field .= $this->wall_symbol . $this->blank_return;
        }
        for ($i = 0; $i < $this->floor_height; $i++) {
            for ($j = 0; $j < $this->width; $j++) {
                $this->field .= $this->floor_symbol;
            }
        }
    }
    
    public function getField() {
        return $this->field;
    }
}