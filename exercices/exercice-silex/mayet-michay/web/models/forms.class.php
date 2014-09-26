<?php

class Forms_Model {

    public function __construct($app) {
        $this->app = $app;
    }
    

    /**
        Send email 
        NOT TESTED BECAUSE OF LOCALHOST
        @return Message sent
    */
    public function send_message($subject, $from, $content) {
        $parameters = array('subject' => $subject, 'from_who' => $from, 'content' => $content);
        $this->app['db']->insert('mails', $parameters);
        
        /*Not tested, must be online*/
        $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array($from))
        ->setTo(array('allan.michay@gmail.com'))
        ->setBody($content);
        
        $this->app['mailer']->send($message);
        
        return 'Message sent.';
    }
}