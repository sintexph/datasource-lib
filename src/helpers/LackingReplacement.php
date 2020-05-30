<?php

namespace SintexDatasource\Helpers;

class LackingReplacement implements \JsonSerializable
{
    public $sis_control_no="";
    public $fabric_type="";
    public $factory="";
    public $sp="";
    public $short_type="";
    public $shift="";
    public $sewing_line="";
    public $handle_user_account="";
    public $sub_con_name="";
    public $remark="";
    public $details=[];
    
    public function __construct($sis_control_no=null,$fabric_type=null,$factory=null,$sp=null,$short_type=null,$shift=null,$sewing_line=null,$handle_user_account=null,$sub_con_name=null,$remark=null,$details=[])
    {
        $this->sis_control_no=$sis_control_no;
        $this->fabric_type=$fabric_type;
        $this->factory=$factory;
        $this->sp=$sp;
        $this->short_type=$short_type;
        $this->shift=$shift;
        $this->sewing_line=$sewing_line;
        $this->handle_user_account=$handle_user_account;
        $this->sub_con_name=$sub_con_name;
        $this->remark=$remark;
        $this->details=$details;
    }


    

    public function jsonSerialize()
    {
        return [
            "SISNumber"=>$this->sis_control_no,
            "FabricType"=>$this->fabric_type,
            "Factory"=>$this->factory,
            "SP"=>$this->sp,
            "ShortType"=>$this->short_type,
            "Shift"=>$this->shift,
            "SewingLine"=>$this->sewing_line,
            "Handleuseraccount"=>$this->handle_user_account,
            "SubconName"=>$this->sub_con_name,
            "Remark"=>$this->remark,
            "details"=>$this->details,
        ];
    }
}
