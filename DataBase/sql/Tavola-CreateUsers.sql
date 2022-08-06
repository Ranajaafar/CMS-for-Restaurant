DROP USER IF EXISTS 'phpUser';
CREATE USER 'phpUser' IDENTIFIED BY 'USER_1234';

DROP USER IF EXISTS 'phpAdmin';
CREATE USER 'phpAdmin' IDENTIFIED BY 'ADMIN_1234';

/* FOR phpAdmin */
GRANT ALL ON tavola.* TO 'phpAdmin';

/* FOR phpUser  */
grant select on tavola.item  to 'phpUser';
grant select on tavola.category to 'phpUser';
grant insert on tavola.contain to 'phpUser';
grant select on tavola.currency to 'phpUser';
grant select on tavola.discount to 'phpUser';
grant select on tavola.extra to 'phpUser';
grant select,insert on tavola.feedback to 'phpUser';
grant select on tavola.have to 'phpUser';
grant select on tavola.offer to 'phpUser';
grant select on tavola.photo to 'phpUser';
grant select,update on tavola.rating to 'phpUser';
grant select,insert on tavola.customer to 'phpUser';
grant select,insert on tavola.order_info to 'phpUser';
grant insert,select on tavola.reservation to 'phpUser';
grant select on tavola.restaurant_info to 'phpUser';

