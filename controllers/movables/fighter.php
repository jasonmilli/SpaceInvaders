<?php namespace Controllers\Movables;

class Fighter extends Base {
    public function command($input) {
        $return = false;
        switch ($input) {
            case '4':
                $this->left();
                break;
            case '6':
                $this->right();
                break;
            case '8':
                $this->up();
                break;
            case '2':
                $this->down();
                break;
            case ' ':
                $return = array('type' => 'bullet', 'value' => $this->fire());
                break;
        }
        return $return;
    }
    
    private function fire() {
        return new Bullet(array(
            'x' => $this->specifications['x'],
            'y' => $this->specifications['y'],
            'symbol' => '"'
        ));
    }
}