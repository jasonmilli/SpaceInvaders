<?php namespace Controllers\Movables;

class Invader extends Base {
    public function left() {
        parent::left();
        return $this->specifications['x'] <= $this->specifications['min_x'] ? 'change' : '';
    }
    
    public function right() {
        parent::right();
        return $this->specifications['x'] >= $this->specifications['max_x'] ? 'change' : '';
    }
    
    public function down() {
        parent::down();
        return $this->specifications['y'] >= $this->specifications['min_y'] ? 'end' : '';
    }
    
    public function hit($invader_dead_symbol) {
        $this->specifications['symbol'] = $invader_dead_symbol;
    }
}
