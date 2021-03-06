<?php namespace Controllers;

class Controller {
    private $field;
    private $fighter;
    private $bullets = array();
    private $ming;
    private $fail;
    
    public function __construct() {
        echo "t";
        $this->fighter = new Movables\Fighter(array(
            'x' => 25,
            'y' => 23,
            'min_x' => 1,
            'max_x' => 49,
            'max_y' => 23,
            'symbol' => '^'
        ));
        $this->ming = new Ming(array('width' => 10, 'height' => 10));
        
        //$tty = fOpen("\con", "rb");
        system("stty -icanon");

        //for ($i = 0; $i < 30; $i++) {
        $microtime = microtime(true);
        while (true) {
            //echo "TT".fGets($tty, 1024);
            //$get = fGets($tty, 1024);
            //$microtime = microtime(true);
            stream_set_blocking(STDIN, false);
            if ($c = fread(STDIN,1)) {
                $this->returner($return = $this->fighter->command($c));
                /*if (microtime(true) > $microtime + 0.2) {
                    break;
                }*/
            }
            if (microtime(true) < $microtime + 0.2) {
		continue;
	    }
		$microtime = microtime(true);
            $bullets = array();
            foreach ($this->bullets as $index => $bullet) {
                if ($bullet->up()) {
                    unset($this->bullets[$index]);
                } elseif ($this->ming->checkHit($bullet)) {
                    unset($this->bullets[$index]);
                } else {
                    $bullets[] = $bullet->getPosition();
                }
            }
            $invaders = $this->ming->getPositions();
            if (empty($invaders)) {
                echo "Success
";
                break;
            }
            //echo fread(STDIN, 1);
            //$fighter->up();
            //print_r($fighter->getPosition());
            //$fighter->command('8');
            $this->field = new \Views\Field(array(
                'height' => 25,
                'width' => 51,
                'fighter_coord' => $this->fighter->getPosition(),
                'bullets' => $bullets,
                'invaders' => $invaders
            ));
            $this->field->drawField();
            echo $this->field->getField();
            
            if ($this->fail) {
                echo "
Fail";
                break;
            }
            $this->fail = $this->ming->move();
            //usleep(200000);
        }
    }
    
    public function returner($return) {
        switch ($return['type']) {
            case 'bullet':
                $this->bullets[] = $return['value'];
                break;
        }
    }
}
