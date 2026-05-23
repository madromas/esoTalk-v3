<?php if(!defined("IN_ESOTALK")) exit;
/**
 * OpauthConnect
 * 
 * @copyright Copyright © 2012 Oleksandr Golubtsov
 * @license   GPLv2 License
 * @package   OpauthСonnect
 * 
 * This file is part of OpauthСonnect plugin. Please see the included license file for usage information
 */

class OcMemberSocialModel extends ETModel {
    
    protected $table = "oc_member_social";
    protected $primaryKey = "id";
    
    public function __construct() {}
    
    public function getAccount($socialId, $service) {
        return ET::SQL()->select("memberId, id, ms.confirmed")
                        ->from($this->table." ms")
                        ->from("member", "member_Id = memberId")
                        ->where(array(
                            "socialId" => $socialId,
                            "socialNetwork" => $service
                        ))
                        ->exec()
                        ->firstRow();
    }
    
    public function getConfirmationData($id) {
        return ET::SQL()->select("socialNetwork, confirmationHash, confirmationSent, profileLink, name, email, username")
                        ->from($this->table)
                        ->from("member", "member_Id = memberId")
                        ->where("id", $id)
                        ->exec()
                        ->firstRow();
    }
    
    public function sentConfirmation($id) {
        return $this->updateById($id, array("confirmationSent" => time()));
    }
    
    public function validateConfirmationHash($hash) {
        if(!$hash) return false;
        $result = $this->get(array("confirmationHash" => $hash));
        if($result) {
            $this->updateById($result[0]["id"], array(
                "confirmationHash" => null,
                "confirmed" => true
            ));
            return $result[0]["member_Id"];
        }
        return false;
    }
    
    public function addAccount($memberId, $socialNetwork, $socialId, $profileLink, $name, $confirmed, $confirmationHash) {
        return $this->create(array(
            "member_Id"        => $memberId,
            "socialNetwork"    => $socialNetwork,
            "socialId"         => $socialId,
            "profileLink"      => $profileLink,
            "name"             => $name,
            "confirmed"        => $confirmed,
            "confirmationHash" => $confirmationHash
        ));
    }
    
    public function getAccounts($memberId) {
        return $this->get(array("member_Id" => $memberId));
    }
    
    public function isApropriateUser($userId, $rowId) {
        return $this->get(array("member_Id" => $userId, "id" => $rowId)) ? true : false;
    }
    
}