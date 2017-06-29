<?php
class UploadPhoto // extends Threaded implements Collectable
{
    private $username;
    private $password;
    private $photo;     // path to the photo
    private $caption;     // caption
    private $completed = false;
    private $error = false;
    private $message = '';
    private $proxy = null;

    private $proxy_login;
    private $proxy_password;
    private $proxy_iporhost;
    private $proxy_port;
    private $proxy_type;


    public function __construct($username, $password, $photo, $caption)
    {
        $this->username = $username;
        $this->password = $password;
        $this->photo = $photo;
        $this->caption = $caption;
    }

    public function setProxy(Proxy $proxy)
    {
        $this->proxy = $proxy;
        $this->proxy_login = $proxy->getLogin();
        $this->proxy_password = $proxy->getPassword();
        $this->proxy_iporhost = $proxy->getIporhost();
        $this->proxy_port = $proxy->getPort();
        $this->proxy_type = $proxy->getType();
    }

    public function run()
    {
        $ig = new \InstagramAPI\Instagram(true, false);
        $ig->setUser($this->username, $this->password);

        if (isset($proxy))
        {
            $url = sprintf("%s://%s:%s@%s:%s", $this->proxy_type, $this->proxy_login, $this->proxy_password,
                $this->proxy_iporhost, $this->proxy_port);
            $ig->setProxy($url);
        }

        try {
            $ig->login();
        } catch (Exception $e) {
            $this->error = true;
            return $this->message = $e->getMessage();
        }

         $metadata = ['caption' => $this->caption];
         // todo: размер фото не более 1080 х 1350
         // нужно предусмотреть проверку и преобразование размера фото
         try {
             $ig->uploadTimelinePhoto($this->photo, $metadata);
         } catch (Exception $e) {
             $this->error = true;
             return $this->message = $e->getMessage();
         }

        $this->completed = true;
    }

    public function isCompleted(): bool {
        return $this->completed;
    }

    public function isError() : bool {
        return $this->error;
    }
    
    public function getMessage() : string {
        return $this->message;
    }

}