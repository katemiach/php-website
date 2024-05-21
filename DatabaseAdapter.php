<?php
interface DatabaseAdapter {
    public function connect();
    public function query($sql);
}
?>
