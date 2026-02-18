ALTER TABLE products ADD continental_shipping varchar(32) DEFAULT NULL;
ALTER TABLE products ADD products_sh_na varchar(32) DEFAULT NULL AFTER continental_shipping;
ALTER TABLE products ADD products_sh_sa varchar(32) DEFAULT NULL AFTER products_sh_na;
ALTER TABLE products ADD products_sh_eu varchar(32) DEFAULT NULL AFTER products_sh_sa;
ALTER TABLE products ADD products_sh_af varchar(32) DEFAULT NULL AFTER products_sh_eu;
ALTER TABLE products ADD products_sh_as varchar(32) DEFAULT NULL AFTER products_sh_af;
ALTER TABLE products ADD products_sh_au varchar(32) DEFAULT NULL AFTER products_sh_as;