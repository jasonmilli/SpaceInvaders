<?php namespace Controllers;

class Ming {
    private $invaders = array();
    private $direction;
    private $height;
    private $width;
    private $previous;
    private $invader_dead_symbol = '*';
    
    public function __construct($data) {
        $this->width = \Libraries\Func::arrayGet($data, 'width', 5);
        $this->height = \Libraries\Func::arrayGet($data, 'height', 1);
        for ($i = 0; $i < $this->height; $i++) {
            for ($j = 0; $j < $this->width; $j++) {
                $this->invaders[] = new Movables\Invader(array(
                    'x' => 9 + $j,
                    'y' => 0 - $i,
                    'symbol' => 'M'
                ));
            }
        }
        $this->direction = \Libraries\Func::arrayGet($data, 'direction', 'left');
        $this->previous = $this->direction == 'left' ? 'right' : 'left';
    }
    
    public function getPositions() {
        $invaders = array();
        foreach ($this->invaders as $invader) {
            $invaders[] = $invader->getPosition();
        }
        return $invaders;
    }
    
    public function move() {
        $end = false;
        $direction = $this->direction;
        foreach ($this->invaders as $index => $invader) {
            $position = $invader->getPosition();
            if ($position['symbol'] == $this->invader_dead_symbol) {
                unset($this->invaders[$index]);
            }
            switch ($invader->{$this->direction}($this->width)) {
                case 'change':
                    $direction = 'down';
                    break;
                case 'end':
                    $end = true;
                    break;
            }
        }
        if ($this->direction == 'down') {
            $this->direction = $this->previous;
            $this->previous = $this->direction == 'left' ? 'right' : 'left';
        } else {
            $this->direction = $direction;
        }
        return $end;
    }
    
    public function checkHit($bullet) {
        $bullet_position = $bullet->getPosition();
        foreach ($this->invaders as $invader) {
            $invader_position = $invader->getPosition();
            if (
                $bullet_position['x'] == $invader_position['x']
                && $bullet_position['y'] == $invader_position['y']
            ) {
                $invader->hit($this->invader_dead_symbol);
		return true;
            }
        }
	return false;
    }
}
