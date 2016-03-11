ALTER TABLE `vehicle_equipment` DROP INDEX `vehicle_equipment_vehicle_idx1`;

ALTER TABLE `vehicle` CHANGE COLUMN `wheelbase_id` `wheelbase_id` INT(11) NULL DEFAULT '0' AFTER `bodystyle`;

ALTER TABLE `vehicle` CHANGE COLUMN `wheelbase_id` `wheelbase_id` INT(11) NULL DEFAULT NULL AFTER `bodystyle`;

ALTER TABLE `vehicle`
	CHANGE COLUMN `country_id` `country_id` INT(11) NULL DEFAULT NULL COMMENT 'manufacturing country' AFTER `derivative`,
	CHANGE COLUMN `model` `model` INT(11) NULL DEFAULT NULL AFTER `make`,
	CHANGE COLUMN `location` `location` INT(11) ZEROFILL NULL DEFAULT NULL AFTER `dealer`,
	CHANGE COLUMN `transmission` `transmission` INT(11) NULL DEFAULT NULL AFTER `reg_no`,
	CHANGE COLUMN `engine` `engine` INT(11) NULL DEFAULT NULL AFTER `transmission`,
	CHANGE COLUMN `bodystyle` `bodystyle` INT(11) NULL DEFAULT NULL AFTER `engine`,
	CHANGE COLUMN `trim_material_id` `trim_material_id` INT(11) NULL DEFAULT NULL AFTER `colour_interior`,
	CHANGE COLUMN `trim_shade_id` `trim_shade_id` INT(11) NULL DEFAULT NULL AFTER `trim_material_id`;

ALTER TABLE `equipment`
	CHANGE COLUMN `vehicle_type` `vehicle_type` INT(11) NULL DEFAULT NULL AFTER `manufacturer_code`,
	CHANGE COLUMN `equipment_meta` `equipment_meta` INT(11) NULL DEFAULT NULL AFTER `category_id`,
	CHANGE COLUMN `list_order` `list_order` INT(11) NOT NULL AFTER `equipment_meta`,
	CHANGE COLUMN `added_by` `added_by` INT(11) NULL DEFAULT NULL AFTER `date_updated`,
	CHANGE COLUMN `updated_by` `updated_by` INT(11) NULL DEFAULT NULL AFTER `added_by`,
	CHANGE COLUMN `data_source` `data_source` INT(11) NULL DEFAULT NULL AFTER `updated_by`,
	CHANGE COLUMN `sys_status` `sys_status` INT(11) NULL DEFAULT NULL AFTER `verified`;

ALTER TABLE `equipment`
	CHANGE COLUMN `list_order` `list_order` INT(11) NOT NULL DEFAULT '0' AFTER `equipment_meta`;

ALTER TABLE `equipment`
	CHANGE COLUMN `verified` `verified` INT(11) NOT NULL DEFAULT '0' AFTER `data_source`;