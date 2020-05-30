<?php

namespace SintexDatasource;

use SintexDatasource\Helpers\LackingReplacement;

class PMSDatasource
{
    const REASONS_URI='/api/Basic/GetReasonID';
    const ACCOUNT_CHECKER_URI='/api/Basic/UserAccountExist';
    const FACTORIES_URI='/api/Basic/GetFactory';
    const SEWING_LINES_URI='/api/Basic/GetSewingLine';
    const SEQUENCES_URI='/api/Basic/GetSeq';
    const PROCESSES_URL='/api/Basic/GetProcess';
    const SAVE_LACKING='/api/PPIC/PostPPICLackingReplacement';
    const RECEIVE_REQUEST='/api/PPIC/PutReceive';
    const SUB_CON_NAMES='/api/Basic/GetSubconName';

    public static function base_uri()
    {
        return config('pms-source.api.url');
    }
    
    private static function get_request($url)
    {
        $basicauth = new \GuzzleHttp\Client(['base_uri' =>static::base_uri()]);
        return $basicauth->request(
            'GET',
            $url
        );
    }

    public static function save_lack(LackingReplacement $lacking_replacement)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => static::base_uri()]);
        $options = [
            'json' =>$lacking_replacement
        ]; 
        $response = $client->post(static::SAVE_LACKING, $options);
        
        return $response->getBody();
    }


    public static function received_request($fabric_type,$tracking_number,$username)
    {
        $success=false;
        try {

            $client = new \GuzzleHttp\Client(["base_uri" => static::base_uri()]);
            $response = $client->put(static::RECEIVE_REQUEST.'?FabricType='.$fabric_type.'&ID='.$tracking_number.'&Handleuseraccount='.$username);
            $data=\json_decode($response->getBody()->getContents());
            $success=true;

        } catch (\Throwable $th) {
            $data=\json_decode($th->getResponse()->getBody()->getContents());
            $success=false;
        }
        
        return [
            'success'=>$success,
            'message'=>$data[0],
        ];

    }
    
    public static function subConNames()
    {
        $result=static::get_request(static::SUB_CON_NAMES)->getBody()->getContents();
        if(empty($result))
            return null;
        else
        { 
            $result=\json_decode($result);
            return $result->resultDt;
        }
    }

    public static function processes()
    {
        $result=static::get_request(static::PROCESSES_URL)->getBody()->getContents();
        if(empty($result))
            return null;
        else
        { 
            $result=\json_decode($result);
            return $result->resultDt;
        }
    }

    public static function sequences($fabric_type,$sp_id)
    {
        $result=static::get_request(static::SEQUENCES_URI.'?FabricType='.$fabric_type.'&SPID='.$sp_id)->getBody()->getContents();
        if(empty($result))
            return null;
        else
        { 
            $result=\json_decode($result);
            return $result->resultDt;
        }
    }

    public static function sewing_lines($factory='')
    {
        $result=static::get_request(static::SEWING_LINES_URI.'?factory='.$factory)->getBody()->getContents();
        if(empty($result))
            return null;
        else
        { 
            $result=\json_decode($result);
            return $result->resultDt;
        }
    }
    public static function factories()
    {
        $result=static::get_request(static::FACTORIES_URI)->getBody()->getContents();
        if(empty($result))
            return null;
        else
        { 
            $result=\json_decode($result);
            return $result->resultDt;
        }
    }

    public static function check_user($username)
    {
        if($username!=null)
        {
            $result=static::get_request(static::ACCOUNT_CHECKER_URI.'?userAccount='.$username)->getBody()->getContents();
            if(empty($result))
                return null;
            else
            { 
                $result=\json_decode($result);
                if($result->resultDt[0]->UserAccountExist=="Y")
                    return true;
                else
                    return false;
            }
                
        }
        return null;
    }


    public static function reasons($fabric_type,$short_type)
    {
        if($fabric_type!=null && $short_type!=null)
        {
            $result=static::get_request(static::REASONS_URI.'?FabricType='.$fabric_type.'&ShortType='.$short_type.'')->getBody()->getContents();
            if(empty($result))
                return null;
            else
            { 
                $result=\json_decode($result);
                return $result->resultDt;
            }
                
        }
        return null;
    }
}
