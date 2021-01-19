<?php

class RequestIaPython
{
    public function addField($fieldName, $fieldValue)
    {
        return 0;
    }

    public function myRequest($data)
    {
        $data = http_build_query($data);
    
        $opts = array(
            'http' =>array(
                'method'  => 'POST',
                'header'=> "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data,
                'timeout' => 60
            )
        );

        $context  = stream_context_create($opts);

        $url = 'http://127.0.0.1:5000/recommender';  

        try 
        {
            $response = file_get_contents($url, false, $context);
            $response = json_decode($response);

        }
        catch(Exception $e)
        {
            
            $response = [];
        }

        return $response;
    }
}