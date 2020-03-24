<?php

namespace SintexDatasource;

class Datasource
{
    public static function settings()
    {
        return config('sintex-datasource');
    }
    private static function request($url)
    {
        $BASE_URI=static::settings()["api"]["url"];
        $AUTHORIZATION=static::settings()["api"]["authorization"];
        $BEARER_NAME=static::settings()["api"]["name"];

        $basicauth = new \GuzzleHttp\Client(['base_uri' =>$BASE_URI]);

        return $basicauth->request(
            'GET',
            $url,
            ['headers' => 
                [
                    'Authorization' => $AUTHORIZATION,
                    'bearer-name' => $BEARER_NAME
                ]
            ]
        );
    }

    /**
     * FIND THE EMPLOYEE FROM DATA SOURCE USING ID NUMBER
     * @param $id_number
     */
    public static function find_employee($id_number=null)
    {
        if($id_number!=null)
        {
            $result=static::request('/api/employee/find?q='.$id_number.'&ac=true')->getBody()->getContents();
            if(empty($result))
                return null;
            else
                return \json_decode($result);
        }
        return null;

    }
    public static function employees($status=1)
    {
        $result=static::request("/api/employee/fetch_all?status=$status&limit=-1")->getBody()->getContents();
        if(empty($result))
            return null;
        else
            return \json_decode($result);

    }
    
    public static function departments()
    {
            $result=static::request('/api/department/get/all')->getBody()->getContents();
            if(empty($result))
                return null;
            else
                return \json_decode($result);

    }
    public static function sections()
    {
            $result=static::request('/api/section/get/all')->getBody()->getContents();
            if(empty($result))
                return null;
            else
                return \json_decode($result);

    }
    public static function factories()
    {
            $result=static::request('/api/factory/get/all')->getBody()->getContents();
            if(empty($result))
                return null;
            else
                return \json_decode($result);

    }

    public static function plantilla($factory=null,$section=null,$department=null)
    {
        $result=static::request('/api/employee/count?factory='.$factory.'&section='.$section.'&department='.$department)->getBody()->getContents();
        if(empty($result))
            return null;
        else
            return \json_decode($result);
    }
}