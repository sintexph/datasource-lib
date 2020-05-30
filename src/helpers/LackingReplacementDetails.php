<?php

namespace SintexDatasource\Helpers;

class LackingReplacementDetails implements \JsonSerializable
{

    public $seq='';
    public $request_qty='';
    public $reason_id='';
    public $reject_qty='';
    public $process='';

    public function __construct($seq,$request_qty,$reason_id,$reject_qty,$process)
    {
        $this->seq=$seq;
        $this->request_qty=$request_qty;
        $this->reason_id=$reason_id;
        $this->reject_qty=$reject_qty;
        $this->process=$process;
    }
  
    public function jsonSerialize()
    {
        return [
            "SEQ"=>$this->seq,
            "RequestQty"=>$this->request_qty,
            "ReasonId"=>$this->reason_id,
            "RejectQty"=>$this->reject_qty,
            "Process"=>$this->process,
        ];
    }
}
