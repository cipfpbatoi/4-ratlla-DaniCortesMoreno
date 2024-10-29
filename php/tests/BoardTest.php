<?php
use PHPUnit\Framework\TestCase;
use Joc4enRatlla\Models\Board;

class BoardTest extends TestCase {
    public $board;

    public function testInitializeBoard(): void {
        $this->board = new Board();
        $this->assertIsArray($this->board->getSlots());
        $this->assertEquals(count($this->board->getSlots()), Board::FILES);
    }
}
