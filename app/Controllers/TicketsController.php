<?php 

require_once __DIR__ . '/../Models/Ticket.php';
require_once __DIR__ . '/../Models/Evento.php';

class TicketsController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

    }

}
?>