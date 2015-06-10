<?php namespace Controllers\Movables;

class Bullet extends Base {
    public function up() {
        if ($this->specifications['y'] > $this->specifications['max_y']) {
            parent::up();
            return false;
        } else {
            return true;
        }
    }
}