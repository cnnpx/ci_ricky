 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproductquantity extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "productquantity";
        $this->_primary_key = "ProductQuantityId";
    }

    public function updateInventory($inventoryData){
        $crUserId = isset($inventoryData['UpdateUserId']) ? $inventoryData['UpdateUserId'] : $inventoryData['CrUserId'];
        $crDateTime = isset($inventoryData['UpdateDateTime']) ? $inventoryData['UpdateDateTime'] : $inventoryData['CrDateTime'];
        $this->db->trans_begin();
        $productQuantityData = $this->getBy(array('ProductId' => $inventoryData['ProductId'], 'ProductChildId' => $inventoryData['ProductChildId'], 'StoreId' => $inventoryData['StoreId'], 'IsLast' => 1), true, '', 'ProductQuantityId, Quantity');
        if($productQuantityData){
            $quantity = $inventoryData['Quantity'];
            if($inventoryData['InventoryTypeId'] == 1) $quantity += $productQuantityData['Quantity'];
            $this->save(array('IsLast' => 0, 'UpdateUserId' => $crUserId, 'UpdateDateTime' => $crDateTime), $productQuantityData['ProductQuantityId']);
        }
        else $quantity = $inventoryData['Quantity'];
        $this->save(array(
            'ProductId' => $inventoryData['ProductId'],
            'ProductChildId' => $inventoryData['ProductChildId'],
            'Quantity' => $quantity,
            'StoreId' => $inventoryData['StoreId'],
            'IsLast' => 1,
            'Comment' => $inventoryData['Comment'],
            'CrUserId' => $crUserId,
            'CrDateTime' => $crDateTime
        ));
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return false;
        }
        else{
            $this->db->trans_commit();
            return true;
        }
    }
}