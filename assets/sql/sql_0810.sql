CREATE TABLE `inventories` (
  `InventoryId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `InventoryTypeId` tinyint(4) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `Comment` VARCHAR(650) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`InventoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE `productquantity` ADD COLUMN `UpdateUserId` INT NULL  AFTER `CrDateTime` , ADD COLUMN `UpdateDateTime` DATETIME NULL  AFTER `UpdateUserId` ;

ALTER TABLE `productchilds` ADD COLUMN `ProductPartId` INT NOT NULL COMMENT 'dung cho Combo'  AFTER `Weight` , ADD COLUMN `VATStatusId` TINYINT NOT NULL  AFTER `ProductPartId` ;
ALTER TABLE `products` ADD COLUMN `GuaranteeMonth` TINYINT NOT NULL  AFTER `AccessoryStatus` ;
ALTER TABLE `productchilds` ADD COLUMN `GuaranteeMonth` TINYINT NOT NULL  AFTER `VATStatusId` ;
ALTER TABLE `productchilds` ADD COLUMN `ProductPartChildId` INT NOT NULL  AFTER `ProductPartId` ;

