<?php namespace Controllers\Movables;

abstract class Base {
    protected $specifications = array(
        'x' => 23,
        'y' => 0,
        'max_x' => 48,
        'min_x' => 0,
        'max_y' => 0,
        'min_y' => 23,
        'width' => 1,
        'height' => 1,
        'speed' => 1,
        'symbol' => 'X'
    );
    
    public function __construct($data) {
        foreach ($data as $key => $value) {
            $this->specifications[$key] = $value;
        }
    }
    
    public function getPosition() {
        return array(
            'x' => $this->specifications['x'], 
            'y' => $this->specifications['y'],
            'symbol' => $this->specifications['symbol']
        );
    }
    
    protected function up() {
        if ($this->specifications['y'] > $this->specifications['max_y']) {
            $this->specifications['y'] -= $this->specifications['speed'];
        }
    }
    
    protected function down() {
        if ($this->specifications['y'] < $this->specifications['min_y']) {
            $this->specifications['y'] += $this->specifications['speed'];
        }
    }
    
    protected function left() {
        if ($this->specifications['x'] > $this->specifications['min_x']) {
            $this->specifications['x'] -= $this->specifications['speed'];
        }
    }
    
    protected function right() {
        if ($this->specifications['x'] < $this->specifications['max_x']) {
            $this->specifications['x'] += $this->specifications['speed'];
        }
    }
}