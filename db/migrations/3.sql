ALTER TABLE `3dwrapp`.`user` ADD COLUMN `registration_confirm_token` CHAR(64) NOT NULL  AFTER `restore_pass_token` ;
