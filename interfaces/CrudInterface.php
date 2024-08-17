<?php

interface CrudInterface
{
    public function read();
    public function create();
    public function delete($id);
    public function getLocalTimeWithZone();
    public function getClientIpAddress();
    public function search($userId);
}
