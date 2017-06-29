<?php

class Proxy
{
    private $iporhost;
    private  $port;
    private $login;
    private $password;
    private $type;

    /**
     * @return string
     */
    public function getIporhost() : string
    {
        return $this->iporhost;
    }

    /**
     * @param string $iporhost
     */
    public function setIporhost($iporhost)
    {
        $this->iporhost = $iporhost;
    }

    /**
     * @return int
     */
    public function getPort() : int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}